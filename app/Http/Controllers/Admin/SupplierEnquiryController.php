<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierEnquiry;

class SupplierEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = SupplierEnquiry::with('category')->latest()->paginate(10);

        return view('admin.supplier-enquiries.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = SupplierEnquiry::with('category')->findOrFail($id);

        return view('admin.supplier-enquiries.show', compact('enquiry'));
    }

    public function destroy($id)
    {
        SupplierEnquiry::findOrFail($id)->delete();

        return response()->json([
        'status' => true,
        'message' => 'Deleted successfully'
    ]);
    }
}