<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zestora - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/toaster.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8" id="form-wrapper">
        <div class="mb-6 text-center">
            <span class="text-3xl font-bold text-red-600">Zestora</span>
            <h2 class="mt-2 text-xl font-semibold text-gray-700">Create an account</h2>
        </div>
        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-600 mb-1">Name</label>
                <input id="name" name="name" type="text" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-1">Email</label>
                <input id="email" name="email" type="email" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
            </div>
            <div class="mb-4 relative">
                <label for="password" class="block text-gray-600 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-8 text-gray-400 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
            <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">Register</button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 font-medium transition">Login</a>
            {{-- <a href="#" id="load-login" data-url="{{ route('login.form') }}">Login</a> --}}
        </div>
    </div>  
    {{-- resources/views/auth/login.blade.php ya jo bhi tera login view ho --}}
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


</body>
</html>
