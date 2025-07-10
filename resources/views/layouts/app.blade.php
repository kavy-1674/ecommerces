<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/toaster.js') }}"></script>
        <script>
            function toggleMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }
        </script>
    </head>
    <body class="bg-gray-100">
        <header class="bg-white shadow sticky top-0 z-50">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="text-2xl font-bold text-red-600">
                    <a href="{{ route('/') }}">Zestora</a>
                </div>
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Shop</a>
                    
                    @if (Auth::check())
                        <a href="{{ route('admin.dashboards') }}" class="text-gray-700 hover:text-red-600 font-medium transition">Dashboard</a>
                    @else
                        <a href="{{ route('login.form') }}" class="text-gray-700 hover:text-red-600 font-medium transition">Login</a>
                    @endif
                    
                    <a href="{{ route('view.carts') }}" class="relative text-gray-700 hover:text-red-600 font-medium transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386a2.25 2.25 0 012.17 1.72l.298 1.192M6.75 7.5h10.5m0 0l1.049 4.197a2.25 2.25 0 01-2.17 2.803H8.871a2.25 2.25 0 01-2.17-1.697L5.25 7.5zm0 0L5.25 7.5m6 10.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                        <span class="cart-count absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5">
                            
                        </span>
                    </a>
                </nav>
                <!-- Mobile menu button -->
                <button class="md:hidden flex items-center" onclick="toggleMenu()">
                    <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
                <nav class="flex flex-col px-4 py-2 space-y-2">
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Shop</a>
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Login</a>
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition">Register</a>
                    <a href="#" class="relative text-gray-700 hover:text-red-600 font-medium transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386a2.25 2.25 0 012.17 1.72l.298 1.192M6.75 7.5h10.5m0 0l1.049 4.197a2.25 2.25 0 01-2.17 2.803H8.871a2.25 2.25 0 01-2.17-1.697L5.25 7.5zm0 0L5.25 7.5m6 10.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                        <span class="cart-count absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5">0</span>
                    </a>
                </nav>
            </div>
        </header>
        <!-- Main content placeholder -->
        <main class="container mx-auto px-4 py-10">
            @yield('content')
        </main>
          <div id="modal-root"></div>
                      
            @guest
                <section class="bg-gray-50 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Stay Updated</h2>
                    <p class="text-gray-600 mb-6">Subscribe to our newsletter for exclusive deals and updates!</p>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <button class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition">Subscribe</button>
                    </div>
                </section>
            @endguest
    </body>
    
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
                        document.querySelectorAll('.cart-count').forEach(el => {
                            el.innerText = data.totalQuantity;
                        });
    
                        if (window.toaster && data.toast?.message) {
                            toaster[data.toast.type](data.toast.message);
                        }
                    });
                });
            });
        });
    </script>
    
</html>
