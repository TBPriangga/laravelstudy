<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Testing Dark Mode</title>

    {{-- ⚠️ CRITICAL: Dark Mode Script HARUS SEBELUM CSS --}}
    <script>
        // Jalankan sebelum page render untuk avoid flashing
        (function() {
            const theme = localStorage.getItem('theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            console.log('Theme from localStorage:', theme);
            console.log('System prefers dark:', systemDark);
            
            if (theme === 'dark' || (!theme && systemDark)) {
                document.documentElement.classList.add('dark');
                console.log('Dark mode ENABLED');
            } else {
                document.documentElement.classList.remove('dark');
                console.log('Dark mode DISABLED');
            }
        })();
    </script>

    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">

    {{-- Simple Debug Panel --}}
    <div class="fixed top-4 right-4 bg-gray-100 dark:bg-gray-800 p-3 rounded-lg shadow-lg text-xs z-50" x-data="{ isDark: document.documentElement.classList.contains('dark') }">
        <div class="font-bold mb-2 text-gray-900 dark:text-white">Debug Panel</div>
        <div class="text-gray-700 dark:text-gray-300">
            Mode: <span x-text="isDark ? '🌙 Dark' : '☀️ Light'"></span>
        </div>
        <div class="text-gray-700 dark:text-gray-300" x-text="'Storage: ' + localStorage.getItem('theme')"></div>
    </div>

    {{-- Navbar dengan Theme Toggle --}}
    <nav class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 transition-colors">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center space-x-2">
                <span class="text-xl font-semibold text-gray-900 dark:text-white">🏢 Login Test</span>
            </a>
            
            {{-- Theme Toggle Button --}}
            <div x-data="themeToggler()">
                <button 
                    @click="toggle()"
                    class="relative w-12 h-12 rounded-lg bg-gray-200 dark:bg-gray-700 
                           hover:bg-gray-300 dark:hover:bg-gray-600 
                           flex items-center justify-center transition-all duration-300
                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    
                    {{-- Sun Icon --}}
                    <svg x-show="!isDark" 
                         xmlns="http://www.w3.org/2000/svg" 
                         class="w-6 h-6 text-yellow-500" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor" 
                         stroke-width="2">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>

                    {{-- Moon Icon --}}
                    <svg x-show="isDark" 
                         xmlns="http://www.w3.org/2000/svg" 
                         class="w-6 h-6 text-indigo-400" 
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
                
                {{-- Debug Info --}}
                <div class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400" x-text="isDark ? 'Dark' : 'Light'"></div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="flex items-center justify-center min-h-[calc(100vh-80px)] px-6 py-12">
        <div class="w-full max-w-md">
            
            {{-- Test Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 transition-colors">
                
                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                        <span class="text-3xl">🔐</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Testing Dark Mode with Tailwind v4</p>
                </div>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email address
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            required 
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                   bg-white dark:bg-gray-900 
                                   text-gray-900 dark:text-white 
                                   placeholder-gray-400 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                                   transition-colors">
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <a href="#" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                                Forgot password?
                            </a>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                   bg-white dark:bg-gray-900 
                                   text-gray-900 dark:text-white 
                                   placeholder-gray-400 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                                   transition-colors">
                    </div>

                    {{-- Submit Button --}}
                    <button 
                        type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 
                               text-white font-semibold rounded-lg 
                               transition-colors shadow-lg hover:shadow-xl
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Sign in
                    </button>
                </form>

                {{-- Footer --}}
                <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                    Not a member?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        Register Now
                    </a>
                </p>
            </div>

            {{-- Color Test Boxes --}}
            <div class="mt-8 grid grid-cols-3 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                    <div class="text-2xl mb-2">📄</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Card BG</div>
                </div>
                <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-center">
                    <div class="text-2xl mb-2">🎨</div>
                    <div class="text-xs text-gray-600 dark:text-gray-300">Secondary</div>
                </div>
                <div class="p-4 bg-indigo-600 dark:bg-indigo-500 rounded-lg text-center">
                    <div class="text-2xl mb-2">✨</div>
                    <div class="text-xs text-white">Accent</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alpine.js Theme Toggle Component --}}
    <script>
        function themeToggler() {
            return {
                isDark: false,
                
                init() {
                    // Check current theme
                    this.isDark = document.documentElement.classList.contains('dark');
                    console.log('Alpine init - isDark:', this.isDark);
                    
                    // Watch for changes
                    this.$watch('isDark', value => {
                        console.log('isDark changed to:', value);
                    });
                },
                
                toggle() {
                    this.isDark = !this.isDark;
                    
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                        console.log('Switched to DARK mode');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                        console.log('Switched to LIGHT mode');
                    }
                    
                    // Force re-check
                    setTimeout(() => {
                        this.isDark = document.documentElement.classList.contains('dark');
                    }, 100);
                }
            }
        }
    </script>

</body>
</html>