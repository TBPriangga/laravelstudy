@php
    use Illuminate\Support\Facades\Session;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <a href="/login"
            class="text-sm font-semibold text-indigo-400 hover:text-indigo-300 transition">Login</a>
    </nav>

    {{-- Content --}}
    <div class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="bg-gray-800 p-8 rounded-xl shadow-lg w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('image/ajii.png') }}" alt="Logo"
                    class="mx-auto h-16 w-auto rounded-full border border-indigo-500 p-1 shadow-md">
                <h2 class="mt-4 text-2xl font-bold text-white">Create your account</h2>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 text-green-800 p-3 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 text-red-800 p-3 text-sm text-left">
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
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Your name" required
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="you@example.com" required
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input id="password" name="password" type="password" placeholder="********" required
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="********" required
                        class="block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-md transition shadow">
                    Register
                </button>
            </form>

            {{-- Footer --}}
            <p class="mt-8 text-center text-sm text-gray-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Sign in</a>
            </p>
        </div>
    </div>

</body>

</html>
