<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Package;
use App\Models\Enquiry;
use App\Models\ContactEnquiry;
use App\Models\HomeEnquiry;
use App\Models\PackageEnquiry;
use App\Models\GeneralEnquiry;
use App\Models\VendorEnquiry;
use App\Models\SupplierEnquiry;

class DashboardController extends Controller
{
    public function index()
    {
       $data = [
    'products' => Product::count(),
    'categories' => Category::count(),
    'packages' => Package::count(),

    'clients' => \App\Models\Client::count(), // ✅ ADD

   'totalEnquiries' =>
    Enquiry::count() +
    ContactEnquiry::count() +
    HomeEnquiry::count() +
    PackageEnquiry::count() +
    GeneralEnquiry::count() +
    VendorEnquiry::count() +
    SupplierEnquiry::count(),

'todayEnquiries' =>
    Enquiry::whereDate('created_at', today())->count() +
    ContactEnquiry::whereDate('created_at', today())->count() +
    HomeEnquiry::whereDate('created_at', today())->count() +
    PackageEnquiry::whereDate('created_at', today())->count() +
    GeneralEnquiry::whereDate('created_at', today())->count() +
    VendorEnquiry::whereDate('created_at', today())->count() +
    SupplierEnquiry::whereDate('created_at', today())->count(),

    'quotationEnquiries' => Enquiry::count(), // ✅ ADD
    'vendorEnquiries' => VendorEnquiry::count(), // ✅ ADD
];

        // ✅ ALL ENQUIRY TYPES (LATEST 5)
        $latestCartEnquiries     = Enquiry::latest()->take(5)->get();
        $latestGeneralEnquiries  = GeneralEnquiry::latest()->take(5)->get();
        $latestContactEnquiries  = ContactEnquiry::latest()->take(5)->get();
        $latestHomeEnquiries     = HomeEnquiry::latest()->take(5)->get();
        $latestPackageEnquiries  = PackageEnquiry::latest()->take(5)->get();
        $latestVendorEnquiries   = VendorEnquiry::latest()->take(5)->get();
        $latestSupplierEnquiries = SupplierEnquiry::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'data',
            'latestCartEnquiries',
            'latestGeneralEnquiries',
            'latestContactEnquiries',
            'latestHomeEnquiries',
            'latestPackageEnquiries',
            'latestVendorEnquiries',
            'latestSupplierEnquiries'
        ));
    }
}