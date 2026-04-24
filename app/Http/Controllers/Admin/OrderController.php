<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    // ALL ORDERS
    public function index()
    {
        $orders = Order::with(['items', 'user'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // PENDING ORDERS
    public function pending()
    {
        $orders = Order::with(['items', 'user'])
            ->where('payment_status', 'pending')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // PAID ORDERS
    public function paid()
    {
        $orders = Order::with(['items', 'user'])
            ->where('payment_status', 'paid')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items', 'user', 'address'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function viewPdf($id)
    {
        $order = Order::with(['items', 'user', 'address'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.orders.pdf', ['order' => $order]);
        return $pdf->stream('invoice-' . $order->invoice_no . '.pdf');
    }

}