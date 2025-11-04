@php
    use Illuminate\Support\Facades\Session;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Astra Juoku Indonesia</title>

    {{-- ✨ TAMBAHAN BARU: Dark Mode Script - HARUS SEBELUM CSS --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (theme === 'dark' || (!theme && systemDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    {{-- ✨ AKHIR TAMBAHAN BARU --}}

    @vite('resources/css/app.css')
    
    {{-- ✨ TAMBAHAN BARU: Alpine.js v3 --}}
    <script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- ✨ AKHIR TAMBAHAN BARU --}}
</head>

{{-- ✨ DIUPDATE: Tambah class dark mode & transition --}}
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex flex-col transition-colors duration-300">

    {{-- ✨ DIUPDATE: Navbar dengan dark mode classes --}}
    <nav class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 transition-colors">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('image/ajii.png') }}" alt="Logo" class="h-10 w-auto">
            <span class="text-xl font-semibold text-gray-900 dark:text-white">Astra Juoku Indonesia</span>
        </a>
        
        {{-- ✨ TAMBAHAN BARU: Theme Toggle + Register Link --}}
        <div class="flex items-center space-x-4">
            {{-- Theme Toggle Button --}}
            <div x-data="themeToggler()">
                <button 
                    @click="toggle()"
                    type="button"
                    class="relative w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 
                           hover:bg-gray-300 dark:hover:bg-gray-600 
                           flex items-center justify-center transition-all duration-300
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm"
                    title="Toggle Dark Mode">
                    
                    {{-- Sun Icon (Light Mode) --}}
                    <svg x-show="!isDark" 
                         xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5 text-amber-500" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor" 
                         stroke-width="2">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>

                    {{-- Moon Icon (Dark Mode) --}}
                    <svg x-show="isDark" 
                         xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5 text-indigo-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor" 
                         stroke-width="2"
                         style="display: none;">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
            
            <a href="/register" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition">
                Register
            </a>
        </div>
        {{-- ✨ AKHIR TAMBAHAN BARU --}}
    </nav>

    {{-- Content --}}
    <div class="flex-grow flex items-center justify-center px-6 py-12">
        {{-- ✨ DIUPDATE: Card dengan dark mode classes --}}
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 w-full max-w-md transition-colors">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('image/ajii.png') }}" alt="Logo"
                    class="mx-auto h-16 w-auto rounded-full border-2 border-indigo-500 p-1 shadow-md">
                <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">Sign in to your account</h2>
            </div>

            {{-- ✨ DIUPDATE: Alert dengan dark mode colors --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 p-3 text-sm text-center transition-colors">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 p-3 text-sm text-center transition-colors">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf

                {{-- ✨ DIUPDATE: Email field dengan dark mode --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>

                {{-- ✨ DIUPDATE: Password field dengan dark mode --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <a href="#" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition">Forgot password?</a>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full rounded-md bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-md transition shadow">
                    Sign in
                </button>
            </form>

            {{-- ✨ DIUPDATE: Footer dengan dark mode --}}
            <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                Not a member?
                <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 font-semibold transition">Register Now</a>
            </p>
        </div>
    </div>

    {{-- ✨ TAMBAHAN BARU: Alpine.js Theme Toggle Logic --}}
    <script>
        function themeToggler() {
            return {
                isDark: false,
                
                init() {
                    // Check current theme on component init
                    this.isDark = document.documentElement.classList.contains('dark');
                },
                
                toggle() {
                    // Toggle theme
                    this.isDark = !this.isDark;
                    
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                }
            }
        }
    </script>
    {{-- ✨ AKHIR TAMBAHAN BARU --}}

</body>

</html>