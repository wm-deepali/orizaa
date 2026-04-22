<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\State;

class CartController extends Controller
{
    // ================= ADD TO CART =================
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $sessionId = session()->getId();

        $cart = Cart::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'subtotal' => 0,
                'discount' => 0,
                'cgst_amount' => 0,
                'sgst_amount' => 0,
                'igst_amount' => 0,
                'total_amount' => 0
            ]
        );

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->total = $item->quantity * $item->price;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'total' => $product->price,
            ]);
        }

        // 🔥 Recalculate cart
        $this->recalculateCart($cart);

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart',
            'cart_count' => $cart->items()->count()
        ]);
    }

    // ================= CART PAGE =================
    public function shoppingCart(Request $request)
    {
        $sessionId = session()->getId();

        $cart = Cart::with('items.product')
            ->where('session_id', $sessionId)
            ->first();

        $cartItems = $cart ? $cart->items : collect();

        // ================= SUBTOTAL =================
        $subtotal = $cartItems->sum('total');

        // ================= COUPON =================
        $discount = session('coupon.discount', 0);

        $subtotalAfterDiscount = $subtotal - $discount;

        // ================= GST =================
        $cgst = Setting::get('cgst', 0);
        $sgst = Setting::get('sgst', 0);
        $igst = Setting::get('igst', 0);

        // TEMP: same state (we will improve later)
        $isSameState = true;

        $cgstAmount = 0;
        $sgstAmount = 0;
        $igstAmount = 0;

        if ($isSameState) {

            $cgstAmount = ($subtotalAfterDiscount * $cgst) / 100;
            $sgstAmount = ($subtotalAfterDiscount * $sgst) / 100;

            $gstType = 'cgst_sgst';

        } else {

            $igstAmount = ($subtotalAfterDiscount * $igst) / 100;

            $gstType = 'igst';
        }

        $gstTotal = $cgstAmount + $sgstAmount + $igstAmount;

        // ================= FINAL =================
        $grandTotal = $subtotalAfterDiscount + $gstTotal;

        $totalItems = $cartItems->sum('quantity');

        $shipping = 0;
        $customization = 0;

        $states = State::orderBy('name')->get();

        return view('front-pages.shopping-cart', compact(
            'cartItems',
            'subtotal',
            'discount',
            'cgstAmount',
            'sgstAmount',
            'igstAmount',
            'gstType',
            'gstTotal',
            'grandTotal',
            'totalItems',
            'shipping',
            'customization',
            'states'
        ));
    }

    // ================= APPLY COUPON =================
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid coupon'
            ]);
        }

        $cart = Cart::where('session_id', session()->getId())
            ->with('items')
            ->first();

        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart empty'
            ]);
        }

        $subtotal = $cart->items->sum('total');

        if ($coupon->min_order_amount && $subtotal < $coupon->min_order_amount) {
            return response()->json([
                'status' => false,
                'message' => 'Minimum order not reached'
            ]);
        }

        // ================= DISCOUNT =================
        if ($coupon->type === 'percentage') {
            $discount = ($subtotal * $coupon->value) / 100;
        } else {
            $discount = $coupon->value;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied'
        ]);
    }

    // ================= REMOVE COUPON =================
    public function removeCoupon()
    {
        session()->forget('coupon');

        return response()->json([
            'status' => true
        ]);
    }

    // ================= REMOVE ITEM =================
    public function removeFromCart(Request $request)
    {
        $item = CartItem::find($request->item_id);

        if ($item) {
            $cart = Cart::find($item->cart_id);

            $item->delete();

            if ($cart) {
                $this->recalculateCart($cart);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    // ================= CENTRAL CALCULATION (🔥 IMPORTANT) =================
    private function recalculateCart($cart)
    {
        $subtotal = $cart->items()->sum('total');

        $discount = session('coupon.discount', 0);

        $subtotalAfterDiscount = $subtotal - $discount;

        $cgst = Setting::get('cgst', 0);
        $sgst = Setting::get('sgst', 0);

        $cgstAmount = ($subtotalAfterDiscount * $cgst) / 100;
        $sgstAmount = ($subtotalAfterDiscount * $sgst) / 100;

        $cart->subtotal = $subtotal;
        $cart->discount = $discount;
        $cart->cgst_amount = $cgstAmount;
        $cart->sgst_amount = $sgstAmount;
        $cart->igst_amount = 0;
        $cart->gst_type = 'cgst_sgst';

        $cart->total_amount = $subtotalAfterDiscount + $cgstAmount + $sgstAmount;

        $cart->save();
    }
}