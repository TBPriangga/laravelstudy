@php
    use Illuminate\Support\Facades\Session;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-6 py-4 bg-gray-900 border-b border-gray-800">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('image/ajii.png') }}" alt="Logo" class="h-10 w-auto">
            <span class="text-xl font-semibold text-white">Astra Juoku Indonesia</span>
        </a>
        <a href="/register"
            class="text-sm font-semibold text-indigo-400 hover:text-indigo-300 transition">Register</a>
    </nav>

    {{-- Content --}}
    <div class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="bg-gray-800 p-8 rounded-xl shadow-lg w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('image/ajii.png') }}" alt="Logo"
                    class="mx-auto h-16 w-auto rounded-full border border-indigo-500 p-1 shadow-md">
                <h2 class="mt-4 text-2xl font-bold text-white">Sign in to your account</h2>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 text-green-800 p-3 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-100 text-red-800 p-3 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300">Forgot password?</a>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-md transition shadow">
                    Sign in
                </button>
            </form>

            {{-- Footer --}}
            <p class="mt-8 text-center text-sm text-gray-400">
                Not a member?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Register
                    Now</a>
            </p>
        </div>
    </div>

</body>

</html>
