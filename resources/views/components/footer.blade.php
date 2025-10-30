<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-screen-xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">

        {{-- Brand Section --}}
        <div class="lg:col-span-2">
            <a href="/"
                class="flex items-center space-x-2 text-2xl font-semibold text-indigo-600 dark:text-gray-100">
                <img src="{{ asset('image/ajii.png') }}" alt="Logo" class="w-10 h-10">
                <span>Astra Juoku Indonesia</span>
            </a>
            <p class="mt-4 text-gray-500 dark:text-gray-400">
                Nextly is a free landing page & marketing website template for startups and indie projects.
                Built with Laravel 11 & TailwindCSS. It’s completely open-source.
            </p>

            {{-- Powered by Laravel --}}
            <div class="mt-6 flex items-center space-x-3">
                <img src="{{ asset('image/Laravel.png') }}" alt="Powered by Laravel" class="w-8 h-8 object-contain">
                <span class="text-gray-600 dark:text-gray-300 text-sm font-medium">Powered by Laravel</span>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="sm:col-span-1">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Navigation</h3>
            <ul class="space-y-2 text-gray-500 dark:text-gray-300">
                <li><a href="#" class="hover:text-indigo-500 transition">Product</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Features</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Pricing</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Company</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Blog</a></li>
            </ul>
        </div>

        {{-- Legal --}}
        <div class="sm:col-span-1">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Legal</h3>
            <ul class="space-y-2 text-gray-500 dark:text-gray-300">
                <li><a href="#" class="hover:text-indigo-500 transition">Terms</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Privacy</a></li>
                <li><a href="#" class="hover:text-indigo-500 transition">Legal</a></li>
            </ul>
        </div>

        {{-- Social Media --}}
        <div class="sm:col-span-1">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Follow us</h3>
            <div class="flex flex-wrap gap-4 text-gray-400 dark:text-gray-500">
                <a href="https://twitter.com" target="_blank" class="hover:text-indigo-500"><i
                        class="fa-brands fa-x-twitter text-2xl"></i></a>
                <a href="https://facebook.com" target="_blank" class="hover:text-indigo-500"><i
                        class="fa-brands fa-facebook text-2xl"></i></a>
                <a href="https://instagram.com" target="_blank" class="hover:text-indigo-500"><i
                        class="fa-brands fa-instagram text-2xl"></i></a>
                <a href="https://linkedin.com" target="_blank" class="hover:text-indigo-500"><i
                        class="fa-brands fa-linkedin text-2xl"></i></a>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div
        class="border-t border-gray-100 dark:border-gray-800 mt-10 py-6 px-4 text-center text-sm text-gray-600 dark:text-gray-400">
        <p class="leading-relaxed">
            © {{ date('Y') }} Made with <span class="text-red-500">♥</span> by
            <a href="#" target="_blank" class="text-indigo-600 hover:underline">TBPriangga</a>.
        </p>
    </div>
</footer>
