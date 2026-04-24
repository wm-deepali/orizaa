<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Review;
use App\Models\Wishlist;

class CustomerController extends Controller
{
    // LIST ALL CUSTOMERS
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('admin.customers.index', compact('customers'));
    }

    // VIEW SINGLE CUSTOMER DETAILS
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $orders = Order::with('items')
            ->where('user_id', $id)
            ->latest()
            ->get();

        $reviews = Review::with('product')
            ->where('user_id', $id)
            ->latest()
            ->get();


        return view('admin.customers.show', compact(
            'customer',
            'orders',
            'reviews',
        ));
    }
}