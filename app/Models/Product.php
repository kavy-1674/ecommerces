<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'product_name',
        'product_sku',
        'description',
        'category',
        'brand',
        'regular_price',
        'sale_price',
        'stock_quantity',
        'weight',
        'width',
        'height',
        'product_type',
        'status',
        'tags',
        'featured',
        'meta_title',
        'keywords',
        'meta_description',
        'shipping_class',
        'tax_status',
        'tax_class',
        'product_images',
    ];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'product_images' => 'array',
    ];
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
