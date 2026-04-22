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
        $query = Product::with('categories');

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
        ]);

        $image = $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : null;

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

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
            'show_on_website' => $request->show_on_website ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'image' => $image,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,
        ]);

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
                'inclusions'
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
        $product = Product::findOrFail($id);

        $image = $product->image;

        if ($request->hasFile('image')) {
            if ($image && Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            $image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

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
            'show_on_website' => $request->show_on_website ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'image' => $image,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,

        ]);

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