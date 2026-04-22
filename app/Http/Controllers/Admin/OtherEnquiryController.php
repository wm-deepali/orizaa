<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralEnquiry;

class OtherEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = GeneralEnquiry::latest()->paginate(10);

        return view('admin.other-enquiries.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = GeneralEnquiry::findOrFail($id);

        return view('admin.other-enquiries.show', compact('enquiry'));
    }

    public function destroy($id)
    {
        GeneralEnquiry::findOrFail($id)->delete();

         return response()->json([
        'status' => true,
        'message' => 'Deleted successfully'
    ]);
    }
}