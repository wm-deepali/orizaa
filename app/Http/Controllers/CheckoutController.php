<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Setting;
use App\Models\State;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $userId = auth('customer')->id();

        $cart = Cart::with('items.product')
            ->when($userId, function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }, function ($q) use ($sessionId) {
                $q->where('session_id', $sessionId);
            })
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shopping-cart')
                ->with('error', 'Cart is empty');
        }

        $cartItems = $cart->items;

        $subtotal = $cartItems->sum('total');
        $discount = session('coupon.discount', 0);
        $subtotalAfterDiscount = $subtotal - $discount;

        $cgst = Setting::get('cgst', 0);
        $sgst = Setting::get('sgst', 0);

        $cgstAmount = ($subtotalAfterDiscount * $cgst) / 100;
        $sgstAmount = ($subtotalAfterDiscount * $sgst) / 100;

        $gstTotal = $cgstAmount + $sgstAmount;
        $grandTotal = $subtotalAfterDiscount + $gstTotal;

        $states = State::orderBy('name')->get();

        $addresses = Address::with(['city', 'state'])
            ->where('user_id', auth('customer')->id())
            ->get();

        return view('front-pages.checkout', compact(
            'cartItems',
            'subtotal',
            'discount',
            'cgstAmount',
            'sgstAmount',
            'gstTotal',
            'grandTotal',
            'states',
            'addresses'
        ));
    }


    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
        ]);

        $user = auth('customer')->user();

        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ]);
        }

        // ✅ SAVE ADDRESS
        // ✅ USE EXISTING ADDRESS IF SELECTED
        if ($request->address_id) {

            $address = Address::where('id', $request->address_id)
                ->where('user_id', $user->id)
                ->first();

        } else {

            // ✅ CREATE NEW ADDRESS ONLY IF NEEDED
            $address = Address::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'pincode' => $request->pincode,
            ]);
        }


        $prefix = Setting::get('invoice_prefix', 'INV');
        $serial = Setting::get('invoice_serial', 1001);

        // generate invoice
        $invoiceNo = $prefix . '-' . $serial;

        // increment serial
        Setting::updateOrCreate(
            ['key' => 'invoice_serial'],
            ['value' => $serial + 1]
        );

        // ✅ CREATE ORDER
        $order = Order::create([
            'order_id' => 'ORD_' . Str::random(10),
            'user_id' => $user->id,
            'address_id' => $address->id,

            // ✅ COPY FROM CART
            'subtotal' => $cart->subtotal,
            'discount' => $cart->discount,

            'cgst_amount' => $cart->cgst_amount,
            'sgst_amount' => $cart->sgst_amount,
            'igst_amount' => $cart->igst_amount,

            'gst_type' => $cart->gst_type,

            'total_amount' => $cart->total_amount,

            // optional (if still using amount)
            'amount' => $cart->total_amount,

            'invoice_no' => $invoiceNo,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'cashfree',
        ]);

        // ✅ SAVE ORDER ITEMS
        foreach ($cart->items as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,

                // ✅ SAFE
                'product_name' => $item->product->name ?? 'Product',

                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->total,
            ]);
        }

        // ================= CASHFREE (cURL) =================

        $url = "https://sandbox.cashfree.com/pg/orders";

        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_APP_ID'),
            "x-client-secret: " . env('CASHFREE_SECRET_KEY')
        ];

        $data = json_encode([
            'order_id' => $order->order_id,
            'order_amount' => number_format($order->amount, 2, '.', ''),
            "order_currency" => "INR",

            "customer_details" => [
                "customer_id" => 'CUST_' . $user->id,
                "customer_name" => $request->first_name,
                "customer_email" => $request->email,
                "customer_phone" => $request->phone,
            ],

            "order_meta" => [
                "return_url" => route('payment.success') . '?order_id={order_id}'
            ]
        ]);

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json([
                'status' => false,
                'message' => curl_error($curl)
            ]);
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['payment_link'])) {
            return response()->json([
                'status' => true,
                'payment_link' => $result['payment_link']
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Payment failed'
        ]);
    }


    public function paymentSuccess(Request $request)
    {
        $orderId = $request->order_id;

        if (!$orderId) {
            return redirect('/')->with('error', 'Invalid payment');
        }

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return redirect('/')->with('error', 'Order not found');
        }

        // ================= VERIFY PAYMENT =================
        $url = "https://sandbox.cashfree.com/pg/orders/" . $orderId;

        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_APP_ID'),
            "x-client-secret: " . env('CASHFREE_SECRET_KEY')
        ];

        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['order_status']) && $result['order_status'] === 'PAID') {

            $order->update([
                'status' => 'paid',
                'payment_status' => 'SUCCESS'
            ]);

            // ✅ CLEAR CART
            Cart::where('user_id', $order->user_id)->delete();
        }

        return view('front-pages.payment-success', compact('order'));
    }
}