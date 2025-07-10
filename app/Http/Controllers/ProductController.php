<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addProduct()
    {
        return view('products.add-product');
    }
    public function storeProduct(StoreProductRequest $request)
    {
        $imagePaths = [];
    
        // ✅ Step 1: Save uploaded images and collect paths
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $path = $image->store('uploads/products', 'public'); // storage/app/public/uploads/products
                $imagePaths[] = $path; // store relative path
            }
        }
    
        // ✅ Step 2: Create Product with all fields
        $product = new Product();
        $product->user_id = auth()->id();
        $product->product_name = $request->product_name;
        $product->product_sku = 'SKU-' . strtoupper(Str::random(8)); // auto-generate
        $product->description = $request->description;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->stock_quantity = $request->stock_quantity;
        $product->weight = $request->weight;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->tags = $request->tags;
        $product->featured = $request->featured ? true : false;
    
        // SEO
        $product->meta_title = $request->meta_title;
        $product->keywords = $request->keywords;
        $product->meta_description = $request->meta_description;
    
        // Shipping & Tax
        $product->shipping_class = $request->shipping_class;
        $product->tax_status = $request->tax_status;
        $product->tax_class = $request->tax_class;
    
        // ✅ Save image paths as JSON
        $product->product_images = $imagePaths;
    
        // ✅ Final save
        $product->save();
    
        // ✅ Redirect with toast
        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Product created successfully!',
        ]);
    }
    public function productManage(Request $request)
    {
        $products = Product::paginate(10);
        // return $products;
        if ($request->ajax()) {
            return view('partials.product_table', compact('products'))->render();
        }
        return view('products.product-manage', compact('products'));
    }
    
    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->filled('name')) {
            $query->where('product_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('price_min')) {
            $query->where('sale_price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('sale_price', '<=', $request->price_max);
        }

        $products = $query->get();

        $html = '';

        foreach ($products as $product) {
            $firstImage = $product->product_images[0] ?? 'uploads/products/default.png';
            $imageUrl = asset('storage/' . $firstImage);
            $fallbackImage = asset('storage/uploads/products/default.png');

            $html .= '
            <tr>
                <td><input type="checkbox" /></td>
                <td>' . ucfirst($product->id) . '</td>
                <td>
                    <img src="' . $imageUrl . '" onerror="this.src=\'' . $fallbackImage . '\'" class="product-image" alt="Product" />
                </td>
                <td>' . ucfirst(strtolower($product->product_name)) . '</td>
                <td>' . ucfirst($product->category) . '</td>
                <td style="color: #10b981; font-weight: 600;">₹' . $product->sale_price . '</td>
                <td>
                    <button class="action-btn edit">Edit</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            </tr>';
        }

        return response()->json(['html' => $html]);
    }


    
}
