@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Astra Juoku Indonesia</title>

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen transition-colors duration-200">
    {{-- Header / Navbar --}}
    <header class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="/home" class="-m-1.5 p-1.5 flex items-center space-x-2">
                    <img src="{{ asset('image/ajii.png') }}" alt="Logo" class="h-12 w-auto">
                    <span class="text-xl font-semibold text-gray-900 dark:text-white">Astra Juoku Indonesia</span>
                </a>
            </div>

            {{-- Dropdown User --}}
            <div class="flex items-center space-x-4" x-data="{ open: false }">
                {{-- Theme Toggle --}}
                @include('components.theme-toggle')

                @if (Auth::check())
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <img src="{{ Auth::user()->avatar ?? asset('image/default-avatar.svg') }}" alt="Avatar"
                                class="w-9 h-9 rounded-full border-2 border-gray-300 dark:border-gray-600 object-cover">
                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-200">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 text-gray-600 dark:text-gray-300 transition-transform duration-200"
                                :class="{ 'rotate-180': open }">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-3 bg-white dark:bg-gray-800 rounded-md shadow-lg w-40 border border-gray-200 dark:border-gray-700 z-50 origin-top-right">
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-t-md transition">
                                Profile
                            </a>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-b-md transition">
                                Logout
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
    </header>

    {{-- Main Content --}}
    <main class="pt-12 px-6 lg:px-8 pb-12">
        <div class="max-w-5xl mx-auto">
            {{-- Alert --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 p-4 shadow text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 p-4 shadow text-center">
                    <ul class="list-disc list-inside text-left inline-block">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Profile Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
                    <img src="{{ asset(Auth::user()->avatar ?? 'image/default-avatar.svg') }}" alt="Avatar"
                        class="w-32 h-32 rounded-full mx-auto border-4 border-indigo-400 object-cover">
                    <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                        Member since {{ Auth::user()->created_at->format('M Y') }}
                    </p>

                    {{-- Remove photo --}}
                    @if (Auth::user()->avatar)
                        <form action="{{ route('profile.deleteAvatar') }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500 font-medium transition">Remove
                                Photo</button>
                        </form>
                    @endif
                </div>

                {{-- Edit Form --}}
                <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Edit Profile</h3>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                        x-data="{ preview: null }" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Upload Avatar --}}
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Change Profile Picture
                            </label>
                            <input type="file" name="avatar" id="avatar" accept="image/*"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="block w-full text-sm text-gray-900 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
                            <template x-if="preview">
                                <div class="mt-4 flex justify-center">
                                    <img :src="preview"
                                        class="w-24 h-24 rounded-full border-2 border-indigo-500 object-cover">
                                </div>
                            </template>
                        </div>

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                required
                                class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                required
                                class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        {{-- Password Section --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-4">Change Password</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Leave blank if you don't want to change password</p>

                            <div class="space-y-4">
                                <input type="password" id="current_password" name="current_password"
                                    placeholder="Current Password"
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                                <input type="password" id="new_password" name="new_password"
                                    placeholder="New Password"
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    placeholder="Confirm New Password"
                                    class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-end space-x-3 pt-6">
                            <a href="/home"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm">
                                Save Changes
                            </button>
                        </div>
                    </form>

                    {{-- Delete Account --}}
                    <form action="{{ route('profile.deleteAccount') }}" method="POST" class="mt-8 text-center border-t border-gray-200 dark:border-gray-700 pt-6">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')"
                            class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500 font-semibold transition">
                            Delete My Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>