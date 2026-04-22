<?php

use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactBranchController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomizationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GiftingOccasionController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\HomeCategoryVideoController;
use App\Http\Controllers\Admin\HomeEnquiryController;
use App\Http\Controllers\Admin\HomeFeatureController;
use App\Http\Controllers\Admin\HomeHeroController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\HomeWhyController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierEnquiryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PackageEnquiryController;
use App\Http\Controllers\Admin\OtherEnquiryController;
use App\Http\Controllers\Admin\VendorEnquiryController;
use App\Http\Controllers\Admin\VendorTypeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\FrontController;


Route::get('/user-login', function () {
    return view('front-pages.login');
})->name('user-login');

Route::get('/user-register', function () {
    return view('front-pages.register');
})->name('user-register');

Route::get('/checkout', function () {
    return view('front-pages.checkout');
})->name('checkout');

Route::get('/user-dashboard', function () {
    return view('front-pages.dashboard');
})->name('user-dashboard');

Route::controller(FrontController::class)->group(function () {

    Route::get('/', 'home')->name('home');
    Route::get('/search-suggestions', 'searchSuggestions')->name('search.suggestions');
    Route::get('/products/filter', 'getProductsByType');
    Route::get('/categories', 'category')->name('category');
    Route::get('/category/{slug}', 'subcategory');
    Route::get('/products', 'products')->name('products');
    Route::get('/product/{slug}', 'productDetail')->name('product.detail');
    Route::get('/thank-you', 'thankYou')->name('thank-you');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/{slug}', 'blogDetails')->name('blog.detail');
    Route::get('/contact-us', 'contactUs')->name('contact-us');
    Route::get('/page/{slug}', 'dynamicPage')->name('dynamic.page');
    Route::get('/why-us', 'whyUs')->name('why-us');
    Route::get('/vendors', 'vendors')->name('vendors');
    Route::get('/membership', 'membership')->name('membership');
    Route::get('/job-openings', 'jobOpenings')->name('job-openings');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/bulk-order', 'bulkOrder')->name('bulk-order');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/awards', 'awards')->name('awards');
    Route::get('/personalised-engraving', 'personalisedEngraving')->name('personalised-engraving');
    Route::get('/recycling-pledge', 'recyclingPledge')->name('recycling-pledge');
    Route::get('/engraving-gallery', 'engravingGallery')->name('engraving-gallery');

    Route::post('/home-enquiry', 'submitHomeEnquiry')->name('home.enquiry');
    Route::post('/enquiry/store', 'storeEnquiry')->name('enquiry.store');
    Route::post('/contact-submit', 'submitContact')->name('contact.submit');
    Route::post('/package-enquiry', 'submitPackageEnquiry')->name('package.enquiry');
    Route::post('/general-enquiry', 'submitGeneralEnquiry')->name('general.enquiry');
    Route::post('/vendor-enquiry', 'submitVendorEnquiry')->name('vendor.enquiry');
    Route::post('/supplier-enquiry', 'submitSupplierEnquiry')->name('supplier.enquiry');

});


Route::controller(CartController::class)->group(function () {

    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::get('/shopping-cart', 'shoppingCart')->name('shopping-cart');
    Route::post('/cart/remove', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/apply-coupon', 'applyCoupon')->name('cart.applyCoupon');
    Route::post('/cart/remove-coupon', 'removeCoupon')->name('cart.removeCoupon');

});

Route::get('/get-cities/{state}', function ($id) {
    return \App\Models\City::where('state_id', $id)->orderBy('name')->get();
});

// Admin Routes list
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/profile-setting', ProfileSettingController::class);
        Route::post('/resetpassword', [ProfileSettingController::class, 'resetPassword'])->name('reset.password');

        Route::resource('categories', CategoryController::class);

        Route::resource('gifting-occasions', GiftingOccasionController::class);

        Route::resource('products', ProductController::class)->names('products');

        Route::resource('customizations', CustomizationController::class);

        Route::resource('pages', DynamicPageController::class)->names('pages');

        Route::resource('faqs', FaqController::class)->names('faqs');

        Route::resource('blogs', BlogController::class)->names('blogs');

        Route::resource('brands', BrandController::class)->names('brands');

        Route::resource('clients', ClientController::class)->names('clients');

        Route::resource('testimonials', TestimonialController::class)->names('testimonials');

        Route::resource('contact-branches', ContactBranchController::class);

        Route::resource('enquiries', EnquiryController::class)->names('enquiries');

        Route::resource('contact-enquiries', ContactEnquiryController::class);

        Route::resource('home-enquiries', HomeEnquiryController::class);

        Route::resource('package-enquiries', PackageEnquiryController::class);

        Route::resource('other-enquiries', OtherEnquiryController::class);

        Route::resource('packages', PackageController::class);

        Route::resource('vendor-enquiries', VendorEnquiryController::class);

        Route::resource('supplier-enquiries', SupplierEnquiryController::class);

        Route::resource('awards', AwardController::class);

        Route::resource('teams', TeamController::class);

        Route::resource('vendor-types', VendorTypeController::class);

        Route::get('/logout', [LogoutController::class, 'logout']);


        // ✅ MAIN DASHBOARD
        Route::get('/home-page', [HomePageController::class, 'index'])
            ->name('home-page.index');

        // ================= HERO =================

        Route::get('/home-sliders', [HomeSliderController::class, 'index'])
            ->name('home.sliders.index');

        Route::post('/home-sliders', [HomeSliderController::class, 'store'])
            ->name('home.sliders.store');

        Route::put('/home-sliders/{id}', [HomeSliderController::class, 'update'])
            ->name('home.sliders.update');

        Route::delete('/home-sliders/{id}', [HomeSliderController::class, 'delete'])
            ->name('home.sliders.delete');


        // ================= WHY SECTION =================
        Route::get('/home-why', [HomeWhyController::class, 'index'])
            ->name('home.why.index');

        Route::post('/home-why/update', [HomeWhyController::class, 'updateSection'])
            ->name('home.why.update');

        Route::post('/home-why/card/store', [HomeWhyController::class, 'storeCard'])
            ->name('home.why.card.store');

        Route::get('/home-why/card/{id}', [HomeWhyController::class, 'editCard'])
            ->name('home.why.card.edit');

        Route::post('/home-why/card/{id}', [HomeWhyController::class, 'updateCard'])
            ->name('home.why.card.update');

        Route::delete('/home-why/card/{id}', [HomeWhyController::class, 'deleteCard'])
            ->name('home.why.card.delete');


        // ================= BANNERS =================
        Route::get('/home-banners', [HomeBannerController::class, 'index'])
            ->name('home.banners.index');

        Route::post('/home-banners', [HomeBannerController::class, 'store'])
            ->name('home.banners.store');

        Route::put('/home-banners/{id}', [HomeBannerController::class, 'update'])
            ->name('home.banners.update');

        Route::delete('/home-banners/{id}', [HomeBannerController::class, 'delete'])
            ->name('home.banners.delete');

        Route::get('/home-features', [HomeFeatureController::class, 'index'])
            ->name('home.features.index');

        Route::post('/home-features', [HomeFeatureController::class, 'store'])
            ->name('home.features.store');

        Route::put('/home-features/{id}', [HomeFeatureController::class, 'update'])
            ->name('home.features.update');

        Route::delete('/home-features/{id}', [HomeFeatureController::class, 'delete'])
            ->name('home.features.delete');

        // ================= CATEGORY VIDEOS =================
        Route::get('/home-category-videos', [HomeCategoryVideoController::class, 'index'])
            ->name('home.category-videos.index');

        Route::post('/home-category-videos', [HomeCategoryVideoController::class, 'store'])
            ->name('home.category-videos.store');

        Route::put('/home-category-videos/{id}', [HomeCategoryVideoController::class, 'update'])
            ->name('home.category-videos.update');

        Route::delete('/home-category-videos/{id}', [HomeCategoryVideoController::class, 'delete'])
            ->name('home.category-videos.delete');

        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::put('/seo/{id}', [SeoController::class, 'update'])->name('seo.update');

        Route::resource('announcements', AnnouncementController::class);

        Route::resource('invoices', InvoiceController::class);

        Route::get('article-suggestions', [InvoiceController::class, 'articleSuggestions']);

        Route::get('get-cities/{state_id}', function ($state_id) {
            return \App\Models\City::where('state_id', $state_id)->get();
        });

        Route::get('invoices/{id}/pdf', [InvoiceController::class, 'viewPdf'])
            ->name('invoices.pdf');

        Route::get('/customer-by-mobile', [InvoiceController::class, 'getCustomer']);

        Route::resource('coupons', CouponController::class);

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    });
});
