<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zestora - Login</title>
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
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <div class="mb-6 text-center">
            <span class="text-3xl font-bold text-red-600">Zestora</span>
            <h2 class="mt-2 text-xl font-semibold text-gray-700">Sign in to your account</h2>
        </div>
        <form id="login-form" method="POST" action="{{ route('login.post') }}">
            @csrf
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
            <div class="mb-4 flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-red-600">
                    <span class="ml-2 text-gray-600 text-sm">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:underline">Forgot password?</a>
            </div>
            <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">Sign In</button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-red-600 hover:underline">Register</a>
        </div>
    </div>
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
