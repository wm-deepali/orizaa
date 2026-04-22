<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;

class ContactEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = ContactEnquiry::latest()->paginate(10);

        return view('admin.contact-enquiries.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = ContactEnquiry::findOrFail($id);

        return view('admin.contact-enquiries.show', compact('enquiry'));
    }

    public function destroy($id)
    {
        ContactEnquiry::findOrFail($id)->delete();

        return response()->json([
        'status' => true,
        'message' => 'Deleted successfully'
    ]);
    }
}