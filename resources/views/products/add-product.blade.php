@extends('admin.layouts.app')

@section('content')
<style>
    .form-container {
        padding: 2rem;
        max-width: 85%;
        transition: all 0.3s ease;
        margin: 0 auto;
        width: 100%;
    }
    
    /* When sidebar is collapsed, increase width */
    .content-collapsed .form-container {
        margin-left: 20px;
        max-width: 95%;
    }
    
    /* When sidebar is expanded, keep width smaller */
    .content-expanded .form-container {
        margin-left: 5px;
        max-width: 85%;
    }
    
    .form-header {
        margin-bottom: 2rem;
    }
    
    .form-title {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .form-subtitle {
        color: #6b7280;
        font-size: 1rem;
    }
    
    .form-sections {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    
    .form-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .section-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .section-icon {
        width: 2rem;
        height: 2rem;
        padding: 0.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    /* Section Colors */
    .section-basic .section-header {
        border-left: 4px solid #3b82f6;
    }
    
    .section-basic .section-icon {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .section-pricing .section-header {
        border-left: 4px solid #10b981;
    }
    
    .section-pricing .section-icon {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .section-images .section-header {
        border-left: 4px solid #f59e0b;
    }
    
    .section-images .section-icon {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }
    
    .section-details .section-header {
        border-left: 4px solid #8b5cf6;
    }
    
    .section-details .section-icon {
        background: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
    }
    
    .section-seo .section-header {
        border-left: 4px solid #ef4444;
    }
    
    .section-seo .section-icon {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .section-shipping .section-header {
        border-left: 4px solid #06b6d4;
    }
    
    .section-shipping .section-icon {
        background: rgba(6, 182, 212, 0.1);
        color: #06b6d4;
    }
    
    .section-body {
        padding: 2rem;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .form-input.error {
        border-color: #ef4444;
    }
    
    .form-input.success {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
        min-height: 120px;
        resize: vertical;
    }
    
    .form-textarea:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .form-textarea.success {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
        background: white;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .form-select.success {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    .form-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .form-checkbox input[type="checkbox"] {
        width: 1rem;
        height: 1rem;
        accent-color: #dc2626;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.95rem;
        margin-top: 0.25rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 4px;
        padding: 0.5rem 0.75rem;
    }
    
    .image-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #f9fafb;
        position: relative;
    }
    
    .image-upload-area:hover {
        border-color: #dc2626;
        background: #fef2f2;
    }
    
    .image-upload-area.has-images {
        border-color: #10b981;
        background: #f0fdf4;
    }
    
    .image-upload-icon {
        width: 3rem;
        height: 3rem;
        color: #9ca3af;
        margin: 0 auto 1rem;
    }
    
    .image-upload-text {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .image-preview-container {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        gap: 1rem !important;
        width: 100% !important;
        overflow-x: auto !important;
        align-items: center !important;
    }

    .image-preview-item {
        width: 96px !important;
        height: 96px !important;
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        border: 2px solid #e5e7eb !important;
        background: #fafafa !important;
    }
    
    .image-preview-item:hover {
        border-color: #dc2626;
        transform: scale(1.05);
    }
    
    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    .image-preview-remove {
        position: absolute;
        top: 0.125rem;
        right: 0.125rem;
        width: 1.25rem;
        height: 1.25rem;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.625rem;
        transition: all 0.3s ease;
    }
    
    .image-preview-remove:hover {
        background: #ef4444;
        transform: scale(1.1);
    }
    
    .image-count {
        position: absolute;
        top: 0.25rem;
        left: 0.25rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.125rem 0.375rem;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 500;
    }
    
    .upload-error {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        background: #fef2f2;
        border-radius: 4px;
        border: 1px solid #fecaca;
    }
    
    .submit-section {
        display: flex;
        justify-content: flex-end;
        padding: 2rem;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
    
    /* Responsive design */
    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .form-container {
            padding: 1rem;
        }
        
        .section-body {
            padding: 1.5rem;
        }
        
        .form-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="form-container">
    <!-- Form Header -->
    <div class="form-header">
        <h1 class="form-title">Add New Product</h1>
        <p class="form-subtitle">Enter all product details to add a new product to your store.</p>
    </div>

    <form id="product-form" action="{{ route('admin.store-product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-sections">
            <!-- Basic Information Section -->
            <div class="form-section section-basic">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="section-title">Basic Information (Required)</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Product Name *</label>
                            <input type="text" 
                                   class="form-input @error('product_name') error @enderror"
                                   name="product_name"
                                   value="{{ old('product_name') }}"
                                   placeholder="Enter product name"
                                   >
                            @error('product_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        

                        {{-- <div class="form-group">
                            <label class="form-label">Product SKU *</label>
                            <input type="text" 
                                   class="form-input @error('product_sku') error @enderror"
                                   name="product_sku"
                                   value="{{ old('product_sku') }}"
                                   placeholder="Enter SKU code"
                                   >
                            @error('product_sku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        
                        <div class="form-group full-width">
                            <label class="form-label">Product Description *</label>
                            <textarea class="form-textarea @error('description') error @enderror"
                                      name="description"
                                      placeholder="Enter detailed product description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Category *</label>
                            <select class="form-select @error('category') error @enderror" name="category" >
                                <option value="">Select category</option>
                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="clothing" {{ old('category') == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                                <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                                <option value="beauty" {{ old('category') == 'beauty' ? 'selected' : '' }}>Beauty</option>
                            </select>
                            @error('category')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Brand</label>
                            <input type="text" 
                                   class="form-input @error('brand') error @enderror"
                                   name="brand"
                                   value="{{ old('brand') }}"
                                   placeholder="Enter brand name">
                            @error('brand')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Inventory Section -->
            <div class="form-section section-pricing">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="section-title">Pricing & Inventory</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Regular Price *</label>
                            <input type="number" 
                                   class="form-input @error('regular_price') error @enderror"
                                   name="regular_price"
                                   value="{{ old('regular_price') }}"
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0"
                                   >
                            @error('regular_price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Sale Price</label>
                            <input type="number" 
                                   class="form-input @error('sale_price') error @enderror"
                                   name="sale_price"
                                   value="{{ old('sale_price') }}"
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0">
                            @error('sale_price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Stock Quantity *</label>
                            <input type="number" 
                                   class="form-input @error('stock_quantity') error @enderror"
                                   name="stock_quantity"
                                   value="{{ old('stock_quantity') }}"
                                   placeholder="0"
                                   min="0"
                                   >
                            @error('stock_quantity')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" 
                                   class="form-input @error('weight') error @enderror"
                                   name="weight"
                                   value="{{ old('weight') }}"
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0">
                            @error('weight')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>                    
                        
                        <div class="form-group">
                            <label class="form-label">Width (cm)</label>
                            <input type="number" 
                                   class="form-input @error('width') error @enderror"
                                   name="width"
                                   value="{{ old('width') }}"
                                   placeholder="0"
                                   min="0">
                            @error('width')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Height (cm)</label>
                            <input type="number" 
                                   class="form-input @error('height') error @enderror"
                                   name="height"
                                   value="{{ old('height') }}"
                                   placeholder="0"
                                   min="0">
                            @error('height')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images & Media Section -->
            <div class="form-section section-images">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h3 class="section-title">Images & Media</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Product Images * (Max 8 images)</label>
                            <div class="image-upload-area" id="image-upload-area">
                                <div class="image-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="image-upload-text">
                                    <p>Click to upload or drag and drop</p>
                                    <p>PNG, JPG, GIF, WEBP up to 10MB each</p>
                                    <p><strong>Selected: <span id="image-count">0</span>/8 images</strong></p>
                                </div>
                                <input type="file" 
                                       name="product_images[]" 
                                       multiple 
                                       accept="image/*"
                                       style="display: none;"
                                       id="product-images">
                                <div class="upload-error" id="upload-error" style="display: none;"></div>
                            </div>
                            <div class="image-preview-container" id="image-preview-container" style="display: none;"></div>
                            @error('product_images')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- <div class="form-group full-width">
                            <label class="form-label">Product Video (Optional)</label>
                            <input type="file" 
                                   class="form-input @error('product_video') error @enderror"
                                   name="product_video"
                                   accept="video/*">
                            @error('product_video')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="form-section section-details">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="section-title">Product Details</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Product Type *</label>
                            <select class="form-select @error('product_type') error @enderror" name="product_type" >
                                <option value="">Select type</option>
                                <option value="simple" {{ old('product_type') == 'simple' ? 'selected' : '' }}>Simple Product</option>
                                <option value="variable" {{ old('product_type') == 'variable' ? 'selected' : '' }}>Variable Product</option>
                                <option value="grouped" {{ old('product_type') == 'grouped' ? 'selected' : '' }}>Grouped Product</option>
                            </select>
                            @error('product_type')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Product Status *</label>
                            <select class="form-select @error('status') error @enderror" name="status" >
                                <option value="">Select status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tags</label>
                            <input type="text" 
                                   class="form-input @error('tags') error @enderror"
                                   name="tags"
                                   value="{{ old('tags') }}"
                                   placeholder="Enter tags separated by commas">
                            @error('tags')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Featured Product</label>
                            <div class="form-checkbox">
                                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                                <span>Mark as featured product</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO & Marketing Section -->
            <div class="form-section section-seo">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="section-title">SEO & Marketing</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Meta Title</label>
                            <input type="text" 
                                   class="form-input @error('meta_title') error @enderror"
                                   name="meta_title"
                                   value="{{ old('meta_title') }}"
                                   placeholder="Enter meta title">
                            @error('meta_title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Keywords</label>
                            <input type="text" 
                                   class="form-input @error('keywords') error @enderror"
                                   name="keywords"
                                   value="{{ old('keywords') }}"
                                   placeholder="Enter keywords separated by commas">
                            @error('keywords')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group full-width">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-textarea @error('meta_description') error @enderror"
                                      name="meta_description"
                                      placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Tax Section -->
            <div class="form-section section-shipping">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="section-title">Shipping & Tax</h3>
                </div>
                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Shipping Class</label>
                            <select class="form-select @error('shipping_class') error @enderror" name="shipping_class">
                                <option value="">Select shipping class</option>
                                <option value="free" {{ old('shipping_class') == 'free' ? 'selected' : '' }}>Free Shipping</option>
                                <option value="standard" {{ old('shipping_class') == 'standard' ? 'selected' : '' }}>Standard Shipping</option>
                                <option value="express" {{ old('shipping_class') == 'express' ? 'selected' : '' }}>Express Shipping</option>
                            </select>
                            @error('shipping_class')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tax Status</label>
                            <select class="form-select @error('tax_status') error @enderror" name="tax_status">
                                <option value="">Select tax status</option>
                                <option value="taxable" {{ old('tax_status') == 'taxable' ? 'selected' : '' }}>Taxable</option>
                                <option value="non-taxable" {{ old('tax_status') == 'non-taxable' ? 'selected' : '' }}>Non-taxable</option>
                            </select>
                            @error('tax_status')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tax Class</label>
                            <select class="form-select @error('tax_class') error @enderror" name="tax_class">
                                <option value="">Select tax class</option>
                                <option value="standard" {{ old('tax_class') == 'standard' ? 'selected' : '' }}>Standard Rate</option>
                                <option value="reduced" {{ old('tax_class') == 'reduced' ? 'selected' : '' }}>Reduced Rate</option>
                                <option value="zero" {{ old('tax_class') == 'zero' ? 'selected' : '' }}>Zero Rate</option>
                            </select>
                            @error('tax_class')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="submit-section">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Add Product
            </button>
        </div>
    </form>
</div>

<script>
    // Form validation and success styling
    document.addEventListener('DOMContentLoaded', function() {
        // Get all form inputs, textareas, and selects
        const formInputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
        
        // Function to check if field has content and add success class
        function checkFieldContent(field) {
            const value = field.value.trim();
            
            // Remove existing error and success classes
            field.classList.remove('error', 'success');
            
            // If field has content, add success class
            if (value !== '') {
                field.classList.add('success');
            }
            
            // If field has error message, add error class
            const errorMessage = field.parentElement.querySelector('.error-message');
            if (errorMessage && errorMessage.style.display !== 'none') {
                field.classList.remove('success');
                field.classList.add('error');
            }
        }
        
        // Add event listeners to all form fields
        formInputs.forEach(field => {
            // Check initial state (for fields with old values)
            checkFieldContent(field);
            
            // Listen for input changes
            field.addEventListener('input', function() {
                checkFieldContent(this);
            });
            
            // Listen for change events (for selects)
            field.addEventListener('change', function() {
                checkFieldContent(this);
            });
            
            // Listen for blur events
            field.addEventListener('blur', function() {
                checkFieldContent(this);
            });
        });
        
        // Handle checkbox separately
        const featuredCheckbox = document.querySelector('input[name="featured"]');
        if (featuredCheckbox) {
            featuredCheckbox.addEventListener('change', function() {
                // For checkbox, we don't add success class as it's optional
                // Just remove error class if it exists
                this.classList.remove('error');
            });
        }
    });
    
    // Image upload functionality
    let selectedImages = [];
    const maxImages = 8;
    
    document.getElementById('image-upload-area').addEventListener('click', function() {
        document.getElementById('product-images').click();
    });
    
    // Drag and drop functionality
    const uploadArea = document.getElementById('image-upload-area');
    
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#dc2626';
        uploadArea.style.background = '#fef2f2';
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#d1d5db';
        uploadArea.style.background = '#f9fafb';
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#d1d5db';
        uploadArea.style.background = '#f9fafb';
        
        const files = Array.from(e.dataTransfer.files);
        handleImageFiles(files);
    });
    
    document.getElementById('product-images').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        handleImageFiles(files);
    });
    
    function handleImageFiles(files) {
        const errorDiv = document.getElementById('upload-error');
        errorDiv.style.display = 'none';
        
        // Filter only image files
        const imageFiles = files.filter(file => {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            return validTypes.includes(file.type);
        });
        
        // Check for invalid files
        const invalidFiles = files.filter(file => {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            return !validTypes.includes(file.type);
        });
        
        if (invalidFiles.length > 0) {
            errorDiv.textContent = `Invalid file type(s): ${invalidFiles.map(f => f.name).join(', ')}. Only images are allowed.`;
            errorDiv.style.display = 'block';
        }
        
        // Check if adding these images would exceed the limit
        if (selectedImages.length + imageFiles.length > maxImages) {
            errorDiv.textContent = `You can only select up to ${maxImages} images. You have ${selectedImages.length} selected and trying to add ${imageFiles.length} more.`;
            errorDiv.style.display = 'block';
            return;
        }
        
        // Add new images to the array
        imageFiles.forEach(file => {
            if (selectedImages.length < maxImages) {
                selectedImages.push(file);
            }
        });
        
        updateImagePreview();
        updateImageCount();
    }
    
    function updateImagePreview() {
        const container = document.getElementById('image-preview-container');
        const uploadArea = document.getElementById('image-upload-area');
        
        if (selectedImages.length > 0) {
            container.style.display = 'block';
            uploadArea.classList.add('has-images');
            
            container.innerHTML = '';
            
            selectedImages.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'image-preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <div class="image-count">${index + 1}</div>
                        <button type="button" class="image-preview-remove" onclick="removeImage(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    container.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        } else {
            container.style.display = 'none';
            uploadArea.classList.remove('has-images');
        }
    }
    
    function updateImageCount() {
        const countElement = document.getElementById('image-count');
        countElement.textContent = selectedImages.length;
        
        // Update the file input to include all selected files
        const fileInput = document.getElementById('product-images');
        const dataTransfer = new DataTransfer();
        selectedImages.forEach(file => {
            dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files;
    }
    
    function removeImage(index) {
        selectedImages.splice(index, 1);
        updateImagePreview();
        updateImageCount();
        
        // Clear error message if it was about too many images
        const errorDiv = document.getElementById('upload-error');
        if (errorDiv.textContent.includes('You can only select up to')) {
            errorDiv.style.display = 'none';
        }
    }
</script>

@endsection
