<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 🔵 iPhone Images
        // $iphoneImages = [];
        // $iphoneSource = public_path('images/products/mobile i phone');
        $target = storage_path('app/public/uploads/products');

        // if (!File::exists($target)) {
        //     File::makeDirectory($target, 0755, true);
        // }

        // foreach (File::files($iphoneSource) as $file) {
        //     $fileName = Str::random(20) . '.' . $file->getExtension();
        //     File::copy($file->getRealPath(), $target . '/' . $fileName);
        //     $iphoneImages[] = 'uploads/products/' . $fileName;
        // }

        // Product::create([
        //     'user_id' => 2,
        //     'product_name' => 'iPhone 14 Pro Max',
        //     'product_sku' => 'SKU-' . strtoupper(Str::random(8)),
        //     'description' => 'Latest iPhone with stunning camera and fast processor.',
        //     'category' => 'electronics',
        //     'brand' => 'Apple',
        //     'regular_price' => 150000,
        //     'sale_price' => 135000,
        //     'stock_quantity' => 10,
        //     'weight' => 0.50,
        //     'width' => 7.1,
        //     'height' => 14.7,
        //     'product_type' => 'simple',
        //     'status' => 'active',
        //     'tags' => 'iphone, mobile, apple',
        //     'featured' => true,
        //     'meta_title' => 'Buy iPhone 14 Pro Max',
        //     'keywords' => 'apple, iphone, pro max',
        //     'meta_description' => 'Top-tier iPhone with powerful specs and elegant design.',
        //     'shipping_class' => 'free',
        //     'tax_status' => 'taxable',
        //     'tax_class' => 'standard',
        //     'product_images' => $iphoneImages,
        // ]);

        // 🔴 Vivo Images
        $vivoImages = [];
        $vivoSource = public_path('images/products/mobile vivo');

        foreach (File::files($vivoSource) as $file) {
            $fileName = Str::random(20) . '.' . $file->getExtension();
            File::copy($file->getRealPath(), $target . '/' . $fileName);
            $vivoImages[] = 'uploads/products/' . $fileName;
        }

        Product::create([
            'user_id' => 2,
            'product_name' => 'Vivo Y100',
            'product_sku' => 'SKU-' . strtoupper(Str::random(8)),
            'description' => 'Slim and stylish Vivo phone with powerful features.',
            'category' => 'electronics',
            'brand' => 'Vivo',
            'regular_price' => 25000,
            'sale_price' => 22999,
            'stock_quantity' => 25,
            'weight' => 0.40,
            'width' => 7.3,
            'height' => 15.2,
            'product_type' => 'simple',
            'status' => 'active',
            'tags' => 'vivo, android, mobile',
            'featured' => true,
            'meta_title' => 'Buy Vivo Y100 Online',
            'keywords' => 'vivo, android, smartphone',
            'meta_description' => 'Affordable and elegant Vivo smartphone for everyday use.',
            'shipping_class' => 'free',
            'tax_status' => 'taxable',
            'tax_class' => 'standard',
            'product_images' => $vivoImages,
        ]);
    }
}
