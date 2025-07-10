<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
// app/Http/Requests/StoreProductRequest.php

public function rules()
{
    return [
        'product_name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[A-Za-z0-9 ]+$/'
        ],
        // 'product_sku' => 'required|string|max:100',
        'description' => 'required|string|max:1000',
        'category' => 'required|string',
        'brand' => 'required|string',
        'regular_price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0|lte:regular_price',
        'stock_quantity' => 'required|integer|min:0',
        'weight' => 'nullable|numeric|min:0',
        'length' => 'nullable|numeric|min:0',
        'width' => 'nullable|numeric|min:0',
        'height' => 'nullable|numeric|min:0',
        'product_type' => 'required|in:simple,variable',
        'status' => 'required|in:active,inactive',
        'tags' => 'nullable|string',
        'featured' => 'nullable|boolean',
        'meta_title' => 'nullable|string|max:255',
        'keywords' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'shipping_class' => 'nullable|string',
        'tax_status' => 'nullable|in:taxable,none',
        'tax_class' => 'nullable|string',
        'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];
}

public function messages()
{
    return [
        'product_name.required' => 'Product name is required.',
        'product_name.regex' => 'Only English letters, numbers, and spaces allowed.',
        'regular_price.required' => 'Regular price is needed.',
        'sale_price.lte' => 'Sale price should be less than or equal to regular price.',
        'product_images.*.image' => 'Each uploaded file must be an image.',
        'product_images.*.mimes' => 'Allowed image types: jpeg, png, jpg, gif, webp.',
        'product_images.*.max' => 'Image size must be under 2MB.',
    ];
}

}
