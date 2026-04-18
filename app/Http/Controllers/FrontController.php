<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Client;
use App\Models\ContactBranch;
use App\Models\ContactEnquiry;
use App\Models\Customization;
use App\Models\Faq;
use App\Models\GiftingOccasion;
use App\Models\HomeEnquiry;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Enquiry;
use App\Models\EnquiryItem;
use App\Models\State;
use App\Models\DynamicPage;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\Team;
use App\Models\PackageEnquiry;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $popularCategories = Category::withCount('children')
            ->whereNull('parent_id')   // ✅ only parent categories
            ->where('is_popular', 1)   // ✅ only popular
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->take(5)
            ->orderBy('sort_order', 'asc')
            ->get();

        $featuredProducts = Product::where('featured', 1)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->take(4)
            ->get();

        $occasions = GiftingOccasion::where('status', 1)
            ->take(5) // same number as UI cards
            ->get();


        $faqs = Faq::where('status', 1)
            ->where('show_home', 1) // only homepage FAQs
            ->get();

        $clients = Client::where('status', 1)->get();

        $brands = Brand::where('status', 1)->get();

        $testimonials = Testimonial::where('status', 1)
            ->latest()
            ->take(6) // adjust based on UI
            ->get();

        $scrollProducts = Product::where('status', 1)
            ->where('show_on_website', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('front-pages.home', compact(
            'popularCategories',
            'featuredProducts',
            'occasions',
            'faqs',
            'clients',
            'brands',
            'testimonials',
            'scrollProducts'
        ));
    }


    public function getProductsByType(Request $request)
    {
        $type = $request->type;

        $query = Product::with('categories')
            ->where('show_on_website', 1)
            ->where('status', 1);

        if ($type == 'premium') {
            $query->where('is_premium', 1);
        } elseif ($type == 'sale') {
            $query->where('sale', 1);
        } elseif ($type == 'best_seller') {
            $query->where('best_seller', 1);
        }

        $products = $query->take(4)->get();

        return response()->json($products);
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->q;

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', "%$query%")
            ->where('show_on_website', 1)
            ->where('status', 1)
            ->take(5)
            ->get(['id', 'name', 'image', 'slug']);

        $categories = Category::withCount('children')
            ->where('show_on_website', 1)
            ->where('status', 1)
            ->where('name', 'LIKE', "%$query%")
            ->take(5)
            ->get(['id', 'name', 'slug']);

        return response()->json([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function category(Request $request)
    {
        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->with('children') // 🔥 important
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('front-pages.category', compact('categories'));
    }

    public function subcategory($slug)
    {
        // Parent Category
        $category = Category::where('slug', $slug)
            ->whereNull('parent_id')
            ->firstOrFail();

        // Subcategories with product count
        $subcategories = Category::where('parent_id', $category->id)
            ->where('show_on_website', 1)
            ->where('status', 1)
            ->withCount(['products', 'subcategoryProducts'])
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        // Total products count (optional)
        $totalProducts = $subcategories->sum(function ($sub) {
            return $sub->products_count + $sub->subcategory_products_count;
        });

        return view('front-pages.subcategory', compact(
            'category',
            'subcategories',
            'totalProducts'
        ));
    }

    public function products(Request $request)
    {
        $slug = $request->subcategory;

        $category = null;
        $parentCategory = null;

        if ($slug) {
            $category = Category::where('slug', $slug)
                ->where('status', 1)
                ->first();

            if ($category && $category->parent_id) {
                $parentCategory = Category::find($category->parent_id);
            } else {
                $parentCategory = $category;
            }
        }

        // Sidebar categories
        $categories = Category::whereNull('parent_id')
            ->with([
                'children' => function ($q) {
                    $q->where('status', 1);
                }
            ])
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Products
        $products = Product::where('status', 1)->where('show_on_website', 1);

        // ✅ CATEGORY + SUBCATEGORY FIX
        if ($category) {

            if ($category->parent_id) {
                $products->whereHas('subcategories', function ($q) use ($category) {
                    $q->where('subcategory_id', $category->id);
                });
            } else {
                $products->whereHas('categories', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                });
            }
        }

        // ✅ PRICE
        if ($request->min_price) {
            $products->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $products->where('price', '<=', $request->max_price);
        }

        // ✅ SPECIAL
        if ($request->new_arrival) {
            $products->where('new_arrival', 1);
        }

        if ($request->featured) {
            $products->where('featured', 1);
        }

        if ($request->pan_india) {
            $products->where('pan_india', 1);
        }

        if ($request->ready_to_ship) {
            $products->where('ready_to_ship', 1);
        }

        if ($request->best_seller) {
            $products->where('best_seller', 1);
        }

        if ($request->sale) {
            $products->where('sale', 1);
        }

        if ($request->is_premium) {
            $products->where('is_premium', 1);
        }

        if ($request->gift_hamper) {
            $products->where('gift_hamper', 1);
        }

        if ($request->bulk_available) {
            $products->where('bulk_available', 1);
        }

        if ($request->brand) {
            $products->whereIn('brand_id', $request->brand);
        }

        // ✅ CUSTOMIZATION
        if ($request->customization) {
            $products->whereHas('customizations', function ($q) use ($request) {
                $q->whereIn('customization_id', $request->customization);
            });
        }

        // ✅ SORT
        switch ($request->sort) {
            case 'low':
                $products->orderBy('price', 'asc');
                break;
            case 'high':
                $products->orderBy('price', 'desc');
                break;
            case 'new':
                $products->latest();
                break;
            case 'popular':
                $products->orderBy('best_seller', 'desc');
                break;
            case 'best':
                $products->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'desc');
                break;
            default:
                $products->latest();
        }

        // ✅ OCCASION FILTER
        if ($request->occasion) {

            $occasionIds = GiftingOccasion::whereIn('slug', $request->occasion)
                ->pluck('id');

            $products->whereHas('occasions', function ($q) use ($occasionIds) {
                $q->whereIn('occasion_id', $occasionIds);
            });
        }

        $products = $products->paginate(12)->withQueryString();

        $customizations = Customization::where('status', 1)->get();

        $occasions = GiftingOccasion::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('front-pages.products', compact(
            'products',
            'categories',
            'category',
            'parentCategory',
            'customizations',
            'occasions',
            'brands'
        ));
    }

    public function productDetail($slug)
    {
        // ✅ MAIN PRODUCT (safe)
        $product = Product::with([
            'customizations',
            'categories',
            'subcategories',
            'inclusions',
            'occasions'
        ])
            ->where('slug', $slug)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->firstOrFail();


        // ✅ CATEGORY IDS
        $categoryIds = $product->categories->pluck('id')->toArray();
        $subCategoryIds = $product->subcategories->pluck('id')->toArray();


        // ✅ RELATED PRODUCTS
        $relatedProducts = Product::where('status', 1)
            ->where('show_on_website', 1)
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($categoryIds, $subCategoryIds) {

                $q->whereHas('categories', function ($q2) use ($categoryIds) {
                    $q2->whereIn('categories.id', $categoryIds);
                })

                    ->orWhereHas('subcategories', function ($q3) use ($subCategoryIds) {
                        $q3->whereIn('categories.id', $subCategoryIds);
                    });
            })
            ->latest()
            ->take(8)
            ->get();


        // ✅ FALLBACK (if no related found)
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('status', 1)
                ->where('show_on_website', 1)
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(8)
                ->get();
        }


        // ✅ NEW ARRIVALS
        $newArrivals = Product::where('status', 1)
            ->where('show_on_website', 1)
            ->where('id', '!=', $product->id)
            ->where('new_arrival', 1)
            ->latest()
            ->take(4)
            ->get();


        return view('front-pages.product-detail', compact(
            'product',
            'relatedProducts',
            'newArrivals'
        ));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // Get session id
        $sessionId = session()->getId();

        // Get or create cart
        $cart = Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['total_amount' => 0]
        );

        // Check if product already exists
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            // Update quantity
            $item->quantity += 1;
            $item->total = $item->quantity * $item->price;
            $item->save();
        } else {
            // Create new item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'total' => $product->price,
            ]);
        }

        // Update cart total
        $cart->total_amount = $cart->items()->sum('total');
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart',
            'cart_count' => $cart->items()->sum('quantity') // 🔥 IMPORTANT
        ]);
    }

    public function shoppingCart(Request $request)
    {
        $sessionId = session()->getId();

        $cart = Cart::with('items.product')
            ->where('session_id', $sessionId)
            ->first();

        $cartItems = $cart ? $cart->items : collect();

        $subtotal = $cartItems->sum('total');
        $totalItems = $cartItems->sum('quantity');

        $shipping = 0;
        $customization = 0;
        $grandTotal = $subtotal + $shipping + $customization;

        // ✅ ADD THIS
        $states = State::orderBy('name')->get();

        return view('front-pages.shopping-cart', compact(
            'cartItems',
            'subtotal',
            'totalItems',
            'shipping',
            'customization',
            'grandTotal',
            'states' // 🔥 IMPORTANT
        ));
    }

    public function removeFromCart(Request $request)
    {
        $item = CartItem::find($request->item_id);

        if ($item) {
            $cart = Cart::find($item->cart_id);

            $item->delete();

            // Update cart total
            if ($cart) {
                $cart->total_amount = $cart->items()->sum('total');
                $cart->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function storeEnquiry(Request $request)
    {
        try {

            // ✅ 1. VALIDATION
            $request->validate([
                'business_name' => 'required|string|max:255',
                'owner_name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|digits_between:10,15',
                'address' => 'required|string',
                'state' => 'required|exists:states,id',
                'city' => 'required|exists:cities,id',
                'g-recaptcha-response' => 'required'
            ]);

            // ✅ 2. GOOGLE RECAPTCHA VERIFY
            $captchaResponse = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            if (!($captchaResponse->json()['success'] ?? false)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Captcha verification failed'
                ], 422);
            }

            // ✅ 3. GET CART (SESSION BASED)
            $sessionId = session()->getId();

            $cart = Cart::with('items')
                ->where('session_id', $sessionId)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your cart is empty'
                ], 400);
            }

            // ✅ 4. CREATE ENQUIRY (STORE IDs)
            $enquiry = Enquiry::create([
                'business_name' => $request->business_name,
                'owner_name' => $request->owner_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'state_id' => $request->state, // ✅ ID
                'city_id' => $request->city,  // ✅ ID
                'session_id' => $sessionId,
            ]);

            // ✅ 5. SAVE ENQUIRY ITEMS
            foreach ($cart->items as $item) {

                EnquiryItem::create([
                    'enquiry_id' => $enquiry->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }

            // ✅ 6. CLEAR CART
            $cart->items()->delete();
            $cart->update(['total_amount' => 0]);

            // ✅ 7. SUCCESS RESPONSE
            return response()->json([
                'status' => true,
                'redirect' => route('thank-you'),
                'message' => 'Enquiry submitted successfully!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() // remove in production
            ], 500);
        }
    }

    public function thankYou(Request $request)
    {
        return view('front-pages.thank-you');
    }

    public function faqs(Request $request)
    {
        $faqs = Faq::where('status', 1)->get();

        return view('front-pages.faqs', compact('faqs'));
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.blogs', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 1)->firstOrFail();

        $relatedBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('front-pages.blog-details', compact('blog', 'relatedBlogs'));
    }

    public function contactUs()
    {
        $branches = ContactBranch::where('status', 1)->get();

        $inquiryTypes = [
            'Bulk Corporate Order',
            'Customization Inquiry',
            'Sample Request',
            'Partnership Opportunity',
            'General Inquiry'
        ];

        return view('front-pages.contact-us', compact('branches', 'inquiryTypes'));
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        // ✅ 2. GOOGLE RECAPTCHA VERIFY
        $captchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($captchaResponse->json()['success'] ?? false)) {
            return response()->json([
                'status' => false,
                'message' => 'Captcha verification failed'
            ], 422);
        }

        ContactEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company' => $request->company,
            'inquiry_type' => $request->inquiry_type,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Enquiry sent successfully!');
    }

    public function dynamicPage($slug)
    {
        // match slug with page_name
        $page = DynamicPage::where('status', 1)
            ->get()
            ->first(function ($p) use ($slug) {
                return Str::slug($p->page_name) === $slug;
            });

        if (!$page) {
            abort(404);
        }

        return view('front-pages.dynamic-page', compact('page'));
    }

    public function whyUs(Request $request)
    {
        $brands = Brand::where('status', 1)->get();
        return view('front-pages.why-us', compact('brands'));
    }

    public function vendors(Request $request)
    {
        return view('front-pages.vendors');
    }

    public function membership(Request $request)
    {
        $packages = Package::with('features')->get();
        return view('front-pages.membership', compact('packages'));
    }

    public function jobOpenings(Request $request)
    {
        return view('front-pages.job-opening');
    }

    public function gallery(Request $request)
    {
        return view('front-pages.gallery');
    }


    public function careers(Request $request)
    {
        return view('front-pages.careers');
    }

    public function bulkOrder(Request $request)
    {
        return view('front-pages.bulk-order');
    }

    public function aboutUs(Request $request)
    {
        $teams = Team::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.about-us', compact('teams'));
    }

    public function awards(Request $request)
    {
        $awards = Award::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.awards', compact('awards'));
    }

    public function personalisedEngraving(Request $request)
    {
        return view('front-pages.personalised-engraving');
    }

    public function recyclingPledge(Request $request)
    {
        return view('front-pages.recycling-pledge');
    }

    public function engravingGallery(Request $request)
    {
        return view('front-pages.engraving-gallery');
    }


    public function submitHomeEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        // 🔥 CAPTCHA VERIFY
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]
        );

        if (!($response->json()['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed'])->withInput();
        }

        // ✅ SAVE DATA
        HomeEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return back()->with('success', 'Thanks! We will contact you soon.');
    }


    public function submitPackageEnquiry(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name' => 'required',
            'company' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'g-recaptcha-response' => 'required',
        ]);


        // 🔥 CAPTCHA VERIFY
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]
        );

        if (!($response->json()['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed'])->withInput();
        }

        PackageEnquiry::create($request->all());

        return back()->with('success', 'Enquiry submitted successfully');
    }

}