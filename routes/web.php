<?php

use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactBranchController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\CustomizationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GiftingOccasionController;
use App\Http\Controllers\Admin\HomeEnquiryController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\FrontController;

Route::controller(FrontController::class)->group(function () {

    Route::get('/', 'home')->name('home');
    Route::get('/search-suggestions', 'searchSuggestions')->name('search.suggestions');
    Route::post('/home-enquiry', 'submitHomeEnquiry')->name('home.enquiry');
    Route::get('/products/filter', 'getProductsByType');
    Route::get('/categories', 'category')->name('category');
    Route::get('/category/{slug}', 'subcategory');
    Route::get('/products', 'products')->name('products');
    Route::get('/product/{slug}', 'productDetail')->name('product.detail');
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::get('/shopping-cart', 'shoppingCart')->name('shopping-cart');
    Route::post('/cart/remove', 'removeFromCart')->name('cart.remove');
    Route::post('/enquiry/store', 'storeEnquiry')->name('enquiry.store');
    Route::get('/thank-you', 'thankYou')->name('thank-you');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/{slug}', 'blogDetails')->name('blog.detail');
    Route::get('/contact-us', 'contactUs')->name('contact-us');
    Route::post('/contact-submit', 'submitContact')->name('contact.submit');
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
    Route::post('/package-enquiry', 'submitPackageEnquiry')->name('package.enquiry');

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

        Route::resource('packages', PackageController::class);

        Route::resource('awards', AwardController::class);

        Route::resource('teams', TeamController::class);

        Route::get('/logout', [LogoutController::class, 'logout']);

    });
});
