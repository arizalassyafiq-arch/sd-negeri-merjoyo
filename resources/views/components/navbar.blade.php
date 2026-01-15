<nav x-data="{
    mobileMenuOpen: false,
    path: window.location.pathname,
    isDark: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    profileOpen: false,

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
        if (route === '/') {
            return this.path === '/' || this.path === '/index.html';
        }
        return this.path.startsWith(route);
    }
}" x-init="$watch('isDark', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark'));
window.addEventListener('theme-changed', e => { isDark = e.detail.isDark; });
if (isDark) document.documentElement.classList.add('dark');" class="fixed w-full z-50 top-4 sm:top-6 px-4 sm:px-8">

    <div
        class="max-w-7xl mx-auto bg-trans/90 dark:bg-gray-900/90 backdrop-blur-md rounded-md shadow-lg border border-white/20 dark:border-gray-700 transition-all duration-300">

        <div class="px-6 py-3 md:px-8 md:py-4">
            <div class="flex justify-between items-center">

                <div class="flex items-center shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <div
                            class="bg-emerald-50 dark:bg-emerald-900/30 p-2 rounded-full group-hover:bg-emerald-100 transition-colors">
                            <span class="material-icons text-emerald-600">school</span>
                        </div>
                        <span class="font-bold text-xl text-gray-800 dark:text-white tracking-tight">
                            SDN <span class="text-emerald-600">Merjoyo</span>
                        </span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="/"
                        :class="isActive('/') ?
                            'bg-emerald-50 text-emerald-600 dark:bg-gray-800 dark:text-emerald-400 font-semibold' :
                            'text-gray-600 dark:text-gray-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium'"
                        class="px-4 py-2 rounded-full text-sm transition-all">
                        Beranda
                    </a>
                    <a href="/artikel"
                        :class="isActive('/artikel') ?
                            'bg-emerald-50 text-emerald-600 dark:bg-gray-800 dark:text-emerald-400 font-semibold' :
                            'text-gray-600 dark:text-gray-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium'"
                        class="px-4 py-2 rounded-full text-sm transition-all">
                        Artikel
                    </a>
                    <a href="/search"
                        :class="isActive('/search') ?
                            'bg-emerald-50 text-emerald-600 dark:bg-gray-800 dark:text-emerald-400 font-semibold' :
                            'text-gray-600 dark:text-gray-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium'"
                        class="px-4 py-2 rounded-full text-sm transition-all">
                        Cari Siswa
                    </a>
                    <button @click="toggleChat()"
                        class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-800 transition-all flex items-center gap-2">
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

                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-gray-900 hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                            Login
                        </a>
                    @endguest

                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center gap-2 pl-2 pr-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                                <div class="relative group">
                                    @if (Auth::user()->avatar)
                                        {{-- Jika User memiliki foto profil --}}
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="w-8 h-8 rounded-full object-cover border border-slate-200 dark:border-slate-700">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan inisial (Fallback) --}}
                                        <div
                                            class="w-8 h-8 rounded-full bg-admin-primary text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 max-w-125 truncate">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="material-icons text-gray-400 text-sm">expand_more</span>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" style="display: none;"
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 z-50">

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:text-emerald-600">
                                    Lihat Profile
                                </a>

                                <form action="/logout" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
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
                class="md:hidden pt-4 pb-2 border-t border-gray-100 dark:border-gray-700 mt-3 space-y-2"
                style="display: none;">

                <a href="/"
                    :class="isActive('/') ? 'bg-emerald-50 text-emerald-600 font-bold' :
                        'text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium'"
                    class="block px-4 py-2.5 rounded-xl text-sm transition-colors">
                    Beranda
                </a>
                <a href="/artikel"
                    :class="isActive('/artikel') ? 'bg-emerald-50 text-emerald-600 font-bold' :
                        'text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium'"
                    class="block px-4 py-2.5 rounded-xl text-sm transition-colors">
                    Artikel
                </a>
                <a href="/search"
                    class="block px-4 py-2.5 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium text-sm transition-colors">
                    Cari Siswa
                </a>
                <button @click="toggleChat()"
                    class="w-full text-left px-4 py-2.5 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-800 font-medium text-sm transition-colors flex items-center gap-2">
                    Diskusi
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                </button>

                <div class="pt-2 mt-2 border-t border-gray-100 dark:border-gray-700">
                    @guest
                        <a href="{{ route('login') }}"
                            class="block w-full text-center bg-gray-900 dark:bg-white text-white dark:text-gray-900 py-3 rounded-xl font-bold shadow-md">
                            Login Siswa / Wali
                        </a>
                    @endguest

                    @auth
                        <div
                            class="px-4 py-3 bg-emerald-50/50 dark:bg-gray-800 rounded-xl mb-2 border border-emerald-100 dark:border-gray-700">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="relative group">
                                    @if (Auth::user()->avatar)
                                        {{-- Jika User memiliki foto profil --}}
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="w-8 h-8 rounded-full object-cover border border-slate-200 dark:border-slate-700">
                                    @else
                                        {{-- Jika tidak ada foto, tampilkan inisial (Fallback) --}}
                                        <div
                                            class="w-8 h-8 rounded-full bg-admin-primary text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 dark:text-white">{{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                                        {{ Auth::user()->role }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}"
                                class="block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg text-sm font-semibold mb-2 transition-colors">
                                Lihat Profile
                            </a>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-center border border-red-200 text-red-600 dark:text-red-400 py-2 rounded-lg text-sm font-semibold hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
