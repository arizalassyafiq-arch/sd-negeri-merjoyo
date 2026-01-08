<nav x-data="{
    mobileMenuOpen: false,
    path: window.location.pathname,
    isDark: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

    toggleTheme() {
        this.isDark = !this.isDark;
        localStorage.theme = this.isDark ? 'dark' : 'light';
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark: this.isDark } }));
    },

    isActive(route) {
        // Jika route '/', pastikan path benar-benar root atau index
        if (route === '/') {
            return this.path === '/' || this.path === '/index.html';
        }
        // Untuk route lain (misal /artikel), cek apakah path diawali route tersebut
        return this.path.startsWith(route);
    }
}" x-init="$watch('isDark', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark'));
window.addEventListener('theme-changed', e => { isDark = e.detail.isDark; });
if (isDark) document.documentElement.classList.add('dark');" class="fixed w-full z-50 top-4 sm:top-6 px-4 sm:px-8">

    <div
        class="max-w-7xl mx-auto bg-white/90 dark:bg-surface-dark/90 backdrop-blur-md rounded-md shadow-lg border border-white/20 dark:border-gray-700 transition-all duration-300">

        <div class="px-6 py-3 md:px-8 md:py-4">
            <div class="flex justify-between items-center">

                <div class="flex items-center shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <div
                            class="bg-primary/10 dark:bg-primary/20 p-2 rounded-full group-hover:bg-primary/20 transition-colors">
                            <span class="material-icons text-primary">school</span>
                        </div>
                        <span class="font-bold text-xl text-gray-800 dark:text-white tracking-tight">
                            SDN <span class="text-primary">Merjoyo</span>
                        </span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">

                    <a href="/"
                        :class="isActive('/') ?
                            'bg-primary/10 text-primary dark:text-primary font-semibold' :
                            'text-gray-600 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-gray-800 font-medium'"
                        class="px-4 py-2 rounded-full text-sm transition-all">
                        Beranda
                    </a>

                    <a href="/artikel"
                        :class="isActive('/artikel') ?
                            'bg-primary/10 text-primary dark:text-primary font-semibold' :
                            'text-gray-600 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-gray-800 font-medium'"
                        class="px-4 py-2 rounded-full text-sm transition-all">
                        Artikel
                    </a>

                    <a href="/search"
                        class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                        Cari Siswa
                    </a>

                    <button @click="toggleChat()"
                        class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-gray-800 transition-all flex items-center gap-2">
                        Diskusi
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                    </button>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <button @click="toggleTheme()"
                        class="p-2.5 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors">
                        <span x-show="!isDark" class="material-icons text-[20px]">dark_mode</span>
                        <span x-show="isDark" style="display: none;"
                            class="material-icons text-[20px]">light_mode</span>
                    </button>

                    <a href="/login"
                        class="bg-gray-900 hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                        Login
                    </a>
                </div>

                <div class="flex items-center gap-3 md:hidden">
                    <button @click="toggleTheme()"
                        class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <span x-show="!isDark" class="material-icons text-[20px]">dark_mode</span>
                        <span x-show="isDark" style="display: none;"
                            class="material-icons text-[20px]">light_mode</span>
                    </button>

                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-600 dark:text-gray-300 focus:outline-none p-1">
                        <span x-text="mobileMenuOpen ? 'close' : 'menu'" class="material-icons text-3xl"></span>
                    </button>
                </div>
            </div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden pt-4 pb-2 border-t border-gray-100 dark:border-gray-700 mt-3 space-y-2"
                style="display: none;">

                <a href="/"
                    :class="isActive('/') ? 'bg-primary/10 text-primary font-bold' :
                        'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium'"
                    class="block px-4 py-2.5 rounded-xl text-sm transition-colors">
                    Beranda
                </a>

                <a href="/artikel"
                    :class="isActive('/artikel') ? 'bg-primary/10 text-primary font-bold' :
                        'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium'"
                    class="block px-4 py-2.5 rounded-xl text-sm transition-colors">
                    Artikel
                </a>

                <a href="#"
                    class="block px-4 py-2.5 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium text-sm transition-colors">
                    Cari Siswa
                </a>

                <button @click="toggleChat()"
                    class="w-full text-left px-4 py-2.5 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium text-sm transition-colors flex items-center gap-2">
                    Diskusi
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                </button>

                <div class="pt-2 mt-2 border-t border-gray-100 dark:border-gray-700">
                    <a href="#"
                        class="block w-full text-center bg-gray-900 dark:bg-white text-white dark:text-gray-900 py-3 rounded-xl font-bold shadow-md">
                        Login Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');

        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            icon.innerText = 'close';
        } else {
            menu.classList.add('hidden');
            icon.innerText = 'menu';
        }
    }
</script>

<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.3s ease-out forwards;
    }
</style>
