@php
    use Illuminate\Support\Facades\Session;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Astra Juoku Indonesia</title>

    {{-- Dark Mode Script --}}
    <script>
        (function() {
            if (localStorage.theme === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex flex-col transition-colors duration-200">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('image/ajii.png') }}" alt="Logo" class="h-10 w-auto">
            <span class="text-xl font-semibold text-gray-900 dark:text-white">Astra Juoku Indonesia</span>
        </a>
        <div class="flex items-center space-x-4">
            @include('components.theme-toggle')
            <a href="/login" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition">Login</a>
        </div>
    </nav>

    {{-- Content --}}
    <div class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('image/ajii.png') }}" alt="Logo"
                    class="mx-auto h-16 w-auto rounded-full border-2 border-indigo-500 p-1 shadow-md">
                <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">Create your account</h2>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 p-3 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 p-3 text-sm text-left">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('register.process') }}" class="space-y-6">
                @csrf

                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Your name" required
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="you@example.com" required
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input id="password" name="password" type="password" placeholder="********" required
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="********" required
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-md transition shadow">
                    Register
                </button>
            </form>

            {{-- Footer --}}
            <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 font-semibold">Sign in</a>
            </p>
        </div>
    </div>

</body>

</html>