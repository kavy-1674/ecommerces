@extends('layouts.app')
@section('title', 'Welcome to Zestora')
@section('content')
<style>
    /* Remove custom toaster CSS - using existing toaster.js instead */
</style>
            <!-- Hero Section -->
            <section class="mb-16">
                <div class="bg-cover bg-center bg-no-repeat rounded-2xl p-8 md:p-12 text-white relative overflow-hidden" style="background-image: url('{{ asset('images/hero_images/meal.jpg') }}');">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="relative z-10 max-w-2xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Zestora</h1>
                        <p class="text-xl mb-8 text-red-100">Discover amazing products at unbeatable prices. Shop the latest trends and get exclusive deals!</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Shop Now</button>
                            <button class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition">Learn More</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Shop by Category</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition cursor-pointer">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Electronics</h3>
                        <p class="text-sm text-gray-600">Latest gadgets</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition cursor-pointer">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Fashion</h3>
                        <p class="text-sm text-gray-600">Trendy clothing</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition cursor-pointer">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Home & Living</h3>
                        <p class="text-sm text-gray-600">Home decor</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition cursor-pointer">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Beauty</h3>
                        <p class="text-sm text-gray-600">Cosmetics & care</p>
                    </div>
                </div>
            </section>

            <!-- Featured Products Section -->
            <section class="mb-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Featured Products</h2>
                    <a href="#" class="text-red-600 hover:text-red-700 font-semibold">View All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($products as $product)
                    @php
                    $firstImage = $product->product_images[0] ?? 'uploads/products/default.png';
                    @endphp
            
                    <!-- Product Card 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        {{-- <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/public/'.$product->product_images[0]) }}');"> --}}
                            <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/'.$firstImage) }}')">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">{{ $product->product_name }}</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="text-sm text-gray-600 ml-2">(4.5)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-red-600">₹{{ number_format($product->sale_price, 2) }} </span>
                                <button onclick="addToCart(1, 'Smart LED TV', 12999)"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition add-to-cart-btn" 
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->product_name }}"
                                    data-price="{{ $product->sale_price }}"
                                    data-image="{{ $product->product_images[0] ?? 'uploads/products/default.png' }}"
                                    >
                                    Add to Cart
                                </button>
                            
                            </div>
                        </div>
                    </div>
                    @endforeach

                   
                </div>
            </section>

            <!-- Special Offers Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Special Offers</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">Flash Sale!</h3>
                        <p class="mb-4">Get up to 50% off on selected electronics. Limited time offer!</p>
                        <button class="bg-white text-orange-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Shop Now</button>
                    </div>
                    <div class="bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">New Customer?</h3>
                        <p class="mb-4">Sign up today and get 20% off your first order!</p>
                        <button class="bg-white text-purple-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Sign Up</button>
                    </div>
                </div>
            </section>


        </main>
        <script src="{{ asset('js/toaster.js') }}"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productPrice = this.dataset.price;
                const productImage = this.dataset.image;    
                
                fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage
                    })
                })
                .then(response => response.json()) 
                .then(data => {
                    console.log('Cart:', data.cart);
                    
                    // Update cart count if element exists
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement && data.totalQuantity !== undefined) {
                        cartCountElement.innerText = data.totalQuantity;
                    }
                    
                    if (data.success) {
                        toaster.success(data.message || 'Item added to cart!');
                    } else {
                        toaster.error(data.message || 'Failed to add item');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toaster.error('Failed to add item to cart');
                });
            });
        });
    });
</script>
    @if(session('toast'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toast = @json(session('toast'));
                if (window.toaster && toast?.type && toast?.message) {
                    toaster[toast.type](toast.message);
                }
            });
        </script>
    @endif
@endsection