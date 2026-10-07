<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Pricebrdown;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function product_list()
    {
        $products = Product::with(['variants', 'category'])->paginate(10);

        return view('admin.products.index', compact('products'));
    }


    public function edit_product($id)

    {


        $product = Product::with(['variants.options', 'category'])->findOrFail($id);

        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function filterProducts(Request $request)
    {
        $query = Product::query();

        if ($request->categories && count($request->categories) > 0) {
            $query->whereIn('category_id', $request->categories);
        }
        if ($request->materials && count($request->materials) > 0) {
            $query->whereIn('material', $request->materials);
        }
        if ($request->stone_types && count($request->stone_types) > 0) {
            $query->whereIn('stone_type', $request->stone_types);
        }
        if ($request->price) {
            $query->where('price', '<=', $request->price);
        }

        $products = $query->get();
        return view('pages.view-product', compact('products'))->render();
    }



//  public function store(Request $request)
// {
//     // dd($request->product_video);
//     $request->validate([
//         'name'             => 'required|string|max:255',
//         'category_id'      => 'required|exists:categories,id',
//         'price'            => 'required|numeric|min:0',
//         'stock'            => 'required|integer|min:0',
//         'show_product'     => 'required',
//         'description'      => 'required|string',
//         'image'            => 'nullable|image|mimes:jpg,jpeg,png',
//         'discount'         => 'nullable|numeric|min:0|max:100',
//         'purity'           => 'required|string',
//         'mrptext'          => 'nullable|string',
//         'color'            => 'required|string',
//         'gross_weight'     => 'required',
//         'net_weight'       => 'required',
//         'type'             => 'required|string',
//         'hylighter'        => 'nullable|string',
//         'hylighter_two'    => 'nullable|string',

//         'gallery_images'   => 'nullable|array',
//         'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png',

//         'product_id'       => 'required',
//         'material'         => 'required|string',
//         'material_price'   => 'required|numeric',
//         'making_price'     => 'required|numeric',
//         'brdiscount'       => 'required|numeric',
//         'tax'              => 'required|numeric',

//         'diamond_weight'   => 'nullable',
//         'stone_weight'     => 'nullable',
//         'silver_weight'    => 'nullable',
//         'gold_weight'      => 'nullable',

//         'product_video'    => 'nullable|array',
//         'product_video.*'  => 'mimes:mp4,mov,avi,webm',
//     ]);

//     $slug = Str::slug($request->name);
//     $originalSlug = $slug;
//     $i = 1;

//     while (Product::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $i++;
//     }

//     $price    = $request->price;
//     $discount = $request->discount ?? 0;
//     $finalPrice = $discount > 0 ? $price * (1 - $discount / 100) : $price;

//     $product = new Product();
//     $product->name           = $request->name;
//     $product->category_id    = $request->category_id;
//     $product->slug           = $slug;
//     $product->net_weight     = $request->net_weight;
//     $product->gross_weight   = $request->gross_weight;
//     $product->color          = $request->color;
//     $product->type           = $request->type;
//     $product->purity         = $request->purity;
//     $product->mrptext        = $request->mrptext;
//     $product->show_product   = $request->show_product;
//     $product->hylighter      = $request->hylighter;
//     $product->hylighter_two  = $request->hylighter_two;
//     $product->original_price = $price;
//     $product->price          = $finalPrice;
//     $product->stock          = $request->stock;
//     $product->discount       = $discount;
//     $product->description    = $request->description;

//     $product->diamond_weight = $request->diamond_weight;
//     $product->stone_weight   = $request->stone_weight;
//     $product->silver_weight  = $request->silver_weight;
//     $product->gold_weight    = $request->gold_weight;

//     // Main Image
//     if ($request->hasFile('image')) {
//         $imageName = time() . '-' . uniqid() . '.' . $request->image->extension();
//         $request->image->move(public_path('uploads/products'), $imageName);
//         $product->image = 'uploads/products/' . $imageName;
//     }

//     // Gallery Images
//     if ($request->hasFile('gallery_images')) {
//         $galleryPaths = [];
//         foreach ($request->file('gallery_images') as $galleryImage) {
//             $galleryName = time() . '-' . uniqid() . '.' . $galleryImage->extension();
//             $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
//             $galleryPaths[] = 'uploads/products/gallery/' . $galleryName;
//         }
//         $product->gallery_images = json_encode($galleryPaths);
//     }

//     // Videos
//     if ($request->hasFile('product_video')) {
//         $videoPaths = [];
//         foreach ($request->file('product_video') as $video) {
//             $videoName = time() . '-' . uniqid() . '.' . $video->extension();
//             $video->move(public_path('uploads/products/video'), $videoName);
//             $videoPaths[] = 'uploads/products/video/' . $videoName;
//         }
//         $product->product_video = json_encode($videoPaths);
//     }

//     $product->save();

//     // Price Breakdown
//     $pricebrdw = new Pricebrdown();
//     $pricebrdw->product_id     = $product->id;
//     $pricebrdw->material       = $request->material;
//     $pricebrdw->material_price = $request->material_price;
//     $pricebrdw->making_price   = $request->making_price;
//     $pricebrdw->brdiscount     = $request->brdiscount;
//     $pricebrdw->tax            = $request->tax;
//     $pricebrdw->save();

//     return redirect()->route('poducts.listing')->with('success', 'Product created successfully!');
// }

public function store(Request $request)
{
    // dd($request->product_video);

    $request->validate([
        'name'             => 'required|string|max:255',
        'category_id'      => 'required|exists:categories,id',
        'price'            => 'required|numeric|min:0',
        'stock'            => 'required|integer|min:0',
        'show_product'     => 'required',
        'description'      => 'required|string',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        'discount'         => 'nullable|numeric|min:0|max:100',

        'purity'           => 'required|string',
        'mrptext'          => 'nullable|string',
        'color'            => 'required|string',
        'gross_weight'     => 'required',
        'net_weight'       => 'required',
        'type'             => 'required|string',

        'hylighter'        => 'nullable|string',
        'hylighter_two'    => 'nullable|string',

        // Gallery Images
        'gallery_images'   => 'nullable',
        'gallery_images.*' => 'image|mimes:jpg,jpeg,png|max:4096',

        // ❌ Remove product_id (new product, no ID yet)
        // 'product_id'       => 'required',

        'material'         => 'required|string',
        'material_price'   => 'required|numeric',
        'making_price'     => 'required|numeric',
        'brdiscount'       => 'required|numeric',
        'tax'              => 'required|numeric',

        'diamond_weight'   => 'nullable',
        'stone_weight'     => 'nullable',
        'silver_weight'    => 'nullable',
        'gold_weight'      => 'nullable',

        // Product Videos
        'product_video'    => 'nullable',
        'product_video.*'  => 'mimes:mp4,mov,avi,webm|max:200000',
    ]);

    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $i = 1;

    while (Product::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $i++;
    }

    $price    = $request->price;
    $discount = $request->discount ?? 0;
    $finalPrice = $discount > 0 ? $price * (1 - ($discount / 100)) : $price;

    $product = new Product();
    $product->name           = $request->name;
    $product->category_id    = $request->category_id;
    $product->slug           = $slug;
    $product->net_weight     = $request->net_weight;
    $product->gross_weight   = $request->gross_weight;
    $product->color          = $request->color;
    $product->type           = $request->type;
    $product->purity         = $request->purity;
    $product->mrptext        = $request->mrptext;
    $product->show_product   = $request->show_product;
    $product->hylighter      = $request->hylighter;
    $product->hylighter_two  = $request->hylighter_two;
    $product->original_price = $price;
    $product->price          = $finalPrice;
    $product->stock          = $request->stock;
    $product->discount       = $discount;
    $product->description    = $request->description;

    $product->diamond_weight = $request->diamond_weight;
    $product->stone_weight   = $request->stone_weight;
    $product->silver_weight  = $request->silver_weight;
    $product->gold_weight    = $request->gold_weight;


    if ($request->hasFile('image')) {
        $imageName = time() . '-' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);
        $product->image = 'uploads/products/' . $imageName;
    }


    if ($request->hasFile('gallery_images')) {
        $galleryPaths = [];
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryName = time() . '-' . uniqid() . '.' . $galleryImage->extension();
            $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
            $galleryPaths[] = 'uploads/products/gallery/' . $galleryName;
        }
        $product->gallery_images = json_encode($galleryPaths);
    }


    if ($request->hasFile('product_video')) {
        $videoPaths = [];
        foreach ($request->file('product_video') as $video) {
            $videoName = time() . '-' . uniqid() . '.' . $video->extension();
            $video->move(public_path('uploads/products/video'), $videoName);
            $videoPaths[] = 'uploads/products/video/' . $videoName;
        }
        $product->product_video = json_encode($videoPaths);
    }

    $product->save();

    // Price Breakdown Save
    $pricebrdw = new Pricebrdown();
    $pricebrdw->product_id     = $product->id;
    $pricebrdw->material       = $request->material;
    $pricebrdw->material_price = $request->material_price;
    $pricebrdw->making_price   = $request->making_price;
    $pricebrdw->brdiscount     = $request->brdiscount;
    $pricebrdw->tax            = $request->tax;
    $pricebrdw->save();

    return redirect()->route('poducts.listing')->with('success', 'Product created successfully!');
}



 public function product_update(Request $request, $id)
{
    $request->validate([
        'name'             => 'required|string|max:255',
        'category_id'      => 'nullable|exists:categories,id',
        'price'            => 'nullable|numeric|min:0',
        'stock'            => 'required|integer|min:0',
        'show_product'     => 'required',
        'description'      => 'nullable|string',
        'discount'         => 'nullable|numeric|min:0|max:100',
        'purity'           => 'required|string',
        'mrptext'          => 'nullable|string',
        'color'            => 'required|string',
        'gross_weight'     => 'required',
        'net_weight'       => 'required',
        'type'             => 'required|string',
        'hylighter'        => 'nullable|string',
        'hylighter_two'    => 'nullable|string',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png',
        'gallery_images'   => 'nullable|array',
        'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
        'diamond_weight'   => 'nullable',
        'stone_weight'     => 'nullable',
        'silver_weight'    => 'nullable',
        'gold_weight'      => 'nullable',
        'material'         => 'required|string',
        'material_price'   => 'required|numeric',
        'making_price'     => 'required|numeric',
        'brdiscount'       => 'required|numeric',
        'tax'              => 'required|numeric',
    ]);

    $product = Product::findOrFail($id);

    // Price logic
    $discount = $request->discount ?? $product->discount ?? 0;
    $priceChanged     = $request->filled('price') && $request->price != $product->original_price;
    $discountChanged  = $request->filled('discount') && $request->discount != $product->discount;

    if ($priceChanged || $discountChanged) {
        $originalPrice = $priceChanged ? $request->price : $product->original_price;
        $finalPrice = $originalPrice * (1 - $discount / 100);

        $product->original_price = $originalPrice;
        $product->price = $finalPrice;
        $product->discount = $discount;
    }

    // Normal update
    $product->name           = $request->name;
    $product->category_id    = $request->category_id;
    $product->color          = $request->color;
    $product->type           = $request->type;
    $product->show_product   = $request->show_product;
    $product->net_weight     = $request->net_weight;
    $product->gross_weight   = $request->gross_weight;
    $product->purity         = $request->purity;
    $product->mrptext        = $request->mrptext;
    $product->hylighter      = $request->hylighter;
    $product->hylighter_two  = $request->hylighter_two;
    $product->stock          = $request->stock;
    $product->description    = $request->description;

    $product->diamond_weight = $request->diamond_weight;
    $product->stone_weight   = $request->stone_weight;
    $product->silver_weight  = $request->silver_weight;
    $product->gold_weight    = $request->gold_weight;


    // Slug update
    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $i = 1;

    while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
        $slug = $originalSlug . '-' . $i++;
    }

    $product->slug = $slug;

    // Single Image update
    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $imageName = time() . '-' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);
        $product->image = 'uploads/products/' . $imageName;
    }

    // Gallery update
    if ($request->hasFile('gallery_images')) {

        $galleryPaths = [];
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryName = time() . '-' . uniqid() . '.' . $galleryImage->extension();
            $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
            $galleryPaths[] = 'uploads/products/gallery/' . $galleryName;
        }

        $existing = json_decode($product->gallery_images ?? '[]', true);
        $product->gallery_images = json_encode(array_merge($existing, $galleryPaths));
    }
 // Decode previous video list
    $existingVideos = json_decode($product->product_video, true) ?? [];

    // 1️⃣ Delete selected videos
    if ($request->has('delete_videos')) {
        foreach ($request->delete_videos as $video) {

            // Delete file from storage
            if (file_exists(public_path($video))) {
                unlink(public_path($video));
            }

            // Remove from array
            $existingVideos = array_filter($existingVideos, function ($v) use ($video) {
                return $v != $video;
            });
        }
    }
    // Video update
    if ($request->hasFile('product_video')) {

        $videoPaths = [];

        foreach ($request->file('product_video') as $video) {
            $videoName = time() . '-' . uniqid() . '.' . $video->extension();
            $video->move(public_path('uploads/products/video'), $videoName);
            $videoPaths[] = 'uploads/products/video/' . $videoName;
        }

        $existingVideos = json_decode($product->product_video ?? '[]', true);
        $product->product_video = json_encode(array_merge($existingVideos, $videoPaths));
    }

    $product->save();

    // Price Breakdown update
    $pricebreak = Pricebrdown::firstOrNew(['product_id' => $product->id]);

    $pricebreak->material       = $request->material;
    $pricebreak->material_price = $request->material_price;
    $pricebreak->making_price   = $request->making_price;
    $pricebreak->brdiscount     = $request->brdiscount;
    $pricebreak->tax            = $request->tax;
    $pricebreak->save();

    return redirect()->route('poducts.listing')
        ->with('success', 'Product updated successfully!');
}


    public function delete_product($id)
    {
        $product = Product::with(['variants.options'])->findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        if ($product->gallery_name) {
            $galleryImages = json_decode($product->gallery_name, true);
            if ($galleryImages && is_array($galleryImages)) {
                foreach ($galleryImages as $img) {
                    if ($img && file_exists(public_path($img))) {
                        unlink(public_path($img));
                    }
                }
            }
        }
        foreach ($product->variants as $variant) {
            if ($variant->image && file_exists(public_path($variant->image))) {
                unlink(public_path($variant->image));
            }
            foreach ($variant->options as $option) {
                $option->delete();
            }
            $variant->delete();
        }
        $product->delete();
        return redirect()->route('poducts.listing')->with('success', 'Product deleted successfully!');
    }



    public function show_cate()
    {
        return view('admin.vendor.add_category');
    }
    public function category_add(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name', 'slug' => 'nullable|string|max:255|unique:categories,slug', 'description' => 'nullable|string',]);

        $slug = $request->slug ?: Str::slug($request->name);
        Category::create(['name' => $request->name, 'slug' => $slug, 'description' => $request->description,]);
        return redirect()->route('category')->with('success', 'Category added successfully!');
    }
    public function category_list()
    {
        $cate_list = Category::paginate(10);
        return view('admin.vendor.category_list', compact('cate_list'));
    }
    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.vendor.category_edit', compact('category'));
    }
    public function category_update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $id, 'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id, 'description' => 'nullable|string',]);
        $category->update(['name' => $request->name, 'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name), 'description' => $request->description,]);
        return redirect()->route('category.listing')->with('success', 'Category updated successfully!');
    }
    public function category_delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.listing')->with('success', 'Category deleted successfully!');
    }

    public function listUsers()
    {
        $userListing = User::all();
        return view('admin.vendor.user_listing', compact('userListing'));
    }


    public function listOrder()
    {
        $orderListing = Order::with(['user', 'items'])->get();
        return view('admin.vendor.order_listing', compact('orderListing'));
    }
    public function offer()
    {
        return view('admin.vendor.offer_cup');
    }

    public function offer_list()
    {
        $cupon = Coupon::paginate(10);
        return view('admin.vendor.offer_cup_list', compact('cupon'));
    }

    public function subcategory()
    {
        return view('admin.subcategory.add_subcategory');
    }


    public function addSubCate(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $subcat  = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name
        ]);

        if ($subcat) {
            return redirect('list/subcate')->with('success', 'Added SubCategory SuccessFully !');
        }
    }
    public function list_subcategory()
    {
        $data_sub = Subcategory::with('category')->get();
        return view('admin.subcategory.subcategory_list', compact('data_sub'));
    }

    public function subcate_delete($id)
    {
        $del = Subcategory::where('id', $id)->delete();
        if ($del) {
            return back()->with('success', 'SubCategory Deleted !');
        }
    }

    public function edit_subCate($id)
    {
        $data  = Subcategory::findOrFail($id);
        return view('admin.subcategory.subcategory_edit', compact('data'));
    }


    public function update_subCate(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255'
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name
        ]);

        return redirect('list/subcate')->with('success', 'Updated SubCategory SuccessFully !');
    }

    
}
