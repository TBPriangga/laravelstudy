{{-- Theme Toggle Component --}}
<div x-data="themeToggle()" class="flex items-center">
    <button @click="toggleTheme()" 
            class="relative inline-flex items-center justify-center w-10 h-10 rounded-lg
                   bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 
                   transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        
        {{-- Sun Icon (Light Mode) --}}
        <svg x-show="!isDark" 
             xmlns="http://www.w3.org/2000/svg" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke-width="1.5" 
             stroke="currentColor" 
             class="w-5 h-5 text-yellow-500">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>

        {{-- Moon Icon (Dark Mode) --}}
        <svg x-show="isDark" 
             xmlns="http://www.w3.org/2000/svg" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke-width="1.5" 
             stroke="currentColor" 
             class="w-5 h-5 text-indigo-400">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
    </button>
</div>

<script>
function themeToggle() {
    return {
        isDark: false,
        
        init() {
            // Check localStorage or system preference
            if (localStorage.theme === 'dark' || 
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                this.isDark = true;
                document.documentElement.classList.add('dark');
            } else {
                this.isDark = false;
                document.documentElement.classList.remove('dark');
            }
        },
        
        toggleTheme() {
            this.isDark = !this.isDark;
            
            if (this.isDark) {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            }
        }
    }
}
</script>