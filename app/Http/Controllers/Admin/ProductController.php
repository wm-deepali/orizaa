<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\GiftingOccasion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customization;
use App\Models\ProductInclusion;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'images']);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::whereNull('parent_id')
                ->where('status', 1)
                ->get(),

            'occasions' => GiftingOccasion::where('status', 1)->get(),

            'customizations' => Customization::where('status', 1)->get(),

            'brands' => Brand::where('status', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|string',
        ]);

        // CREATE PRODUCT
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

            'video_url' => $request->video_url,

            'sku' => $request->sku,
            'min_qty' => $request->min_qty,
            'delivery_time' => $request->delivery_time,

            'quality' => $request->quality ? 1 : 0,
            'pan_india' => $request->pan_india ? 1 : 0,

            'mrp' => $request->mrp ?? 0,
            'discount' => $request->discount ?? 0,
            'discount_type' => $request->discount_type,
            'price' => $request->price ?? 0,

            // FLAGS
            'featured' => $request->featured ? 1 : 0,
            'new_arrival' => $request->new_arrival ? 1 : 0,
            'sale' => $request->sale ? 1 : 0,
            'best_seller' => $request->best_seller ? 1 : 0,

            'ready_to_ship' => $request->ready_to_ship ? 1 : 0,
            'bulk_available' => $request->bulk_available ? 1 : 0,
            'gift_hamper' => $request->gift_hamper ? 1 : 0,

            'is_premium' => $request->is_premium ? 1 : 0,
            'is_engraving' => $request->is_engraving ? 1 : 0,
            'is_personalized_engraving' => $request->is_personalized_engraving ? 1 : 0,
            'is_limited_edition' => $request->is_limited_edition ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,
        ]);

        // MULTIPLE IMAGES SAVE
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $img) {

                $path = $img->store('products', 'public');

                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_default' => ($request->default_image == $index) ? 1 : 0
                ]);
            }
        }

        // RELATIONS
        $product->categories()->sync($request->categories ?? []);
        $product->subcategories()->sync($request->sub_categories ?? []);
        $product->occasions()->sync($request->occasions ?? []);
        $product->customizations()->sync($request->customizations ?? []);

        // INCLUSIONS
        if ($request->inclusions) {
            foreach ($request->inclusions as $inc) {
                if (!empty($inc)) {
                    ProductInclusion::create([
                        'product_id' => $product->id,
                        'title' => $inc
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Created Successfully');
    }
    public function edit($id)
    {
        return view('admin.products.edit', [
            'product' => Product::with([
                'categories',
                'subcategories',
                'occasions',
                'customizations',
                'inclusions',
                'images' // ✅ IMPORTANT
            ])->findOrFail($id),

            'categories' => Category::whereNull('parent_id')
                ->where('status', 1)
                ->get(),

            'occasions' => GiftingOccasion::where('status', 1)->get(),
            'customizations' => Customization::where('status', 1)->get(),
            'brands' => Brand::where('status', 1)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        // UPDATE PRODUCT (NO SINGLE IMAGE)
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

            'video_url' => $request->video_url,

            'sku' => $request->sku,
            'min_qty' => $request->min_qty,
            'delivery_time' => $request->delivery_time,

            'quality' => $request->quality ? 1 : 0,
            'pan_india' => $request->pan_india ? 1 : 0,

            'mrp' => $request->mrp ?? 0,
            'discount' => $request->discount ?? 0,
            'discount_type' => $request->discount_type,
            'price' => $request->price ?? 0,

            'featured' => $request->featured ? 1 : 0,
            'new_arrival' => $request->new_arrival ? 1 : 0,
            'sale' => $request->sale ? 1 : 0,
            'best_seller' => $request->best_seller ? 1 : 0,

            'ready_to_ship' => $request->ready_to_ship ? 1 : 0,
            'bulk_available' => $request->bulk_available ? 1 : 0,
            'gift_hamper' => $request->gift_hamper ? 1 : 0,

            'is_premium' => $request->is_premium ? 1 : 0,
            'is_engraving' => $request->is_engraving ? 1 : 0,
            'is_personalized_engraving' => $request->is_personalized_engraving ? 1 : 0,
            'is_limited_edition' => $request->is_limited_edition ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,
        ]);

        // ✅ ADD NEW IMAGES (OLD DELETE NAHI KAR RAHE - SAFE APPROACH)
        $defaultType = $request->default_type;

        // RESET ALL DEFAULTS
        $product->images()->update(['is_default' => 0]);

        // ✅ EXISTING DEFAULT
        if ($defaultType && str_starts_with($defaultType, 'old_')) {

            $id = str_replace('old_', '', $defaultType);

            \App\Models\ProductImage::where('id', $id)
                ->where('product_id', $product->id)
                ->update(['is_default' => 1]);
        }

        // ✅ NEW IMAGES
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {

                $path = $img->store('products', 'public');

                $isDefault = 0;

                if ($defaultType === "new_" . $index) {
                    $isDefault = 1;
                }

                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_default' => $isDefault
                ]);
            }
        }

        // DELETE SELECTED IMAGES
        if ($request->delete_images) {
            foreach ($request->delete_images as $imgId) {

                $img = \App\Models\ProductImage::find($imgId);

                if ($img) {
                    if (Storage::disk('public')->exists($img->image)) {
                        Storage::disk('public')->delete($img->image);
                    }
                    $img->delete();
                }
            }
        }

        // RELATIONS
        $product->categories()->sync($request->categories ?? []);
        $product->subcategories()->sync($request->sub_categories ?? []);
        $product->occasions()->sync($request->occasions ?? []);
        $product->customizations()->sync($request->customizations ?? []);

        // INCLUSIONS
        $product->inclusions()->delete();

        if ($request->inclusions) {
            foreach ($request->inclusions as $inc) {
                if (!empty($inc)) {
                    ProductInclusion::create([
                        'product_id' => $product->id,
                        'title' => $inc
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product Deleted Successfully'
        ]);
    }
}