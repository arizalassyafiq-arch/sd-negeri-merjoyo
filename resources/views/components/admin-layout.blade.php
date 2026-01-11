<!DOCTYPE html>
<html lang="id" x-data="layoutManager()" x-init="initTheme()" :class="{ 'dark': isDark }">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? 'EduAdmin Dashboard' }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=block"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-admin bg-admin-bg-light dark:bg-admin-bg-dark text-slate-900 dark:text-slate-100 antialiased overflow-hidden">

    {{-- Script Gabungan: Theme & Sidebar State --}}
    <script>
        function layoutManager() {
            return {
                isDark: false,
                sidebarOpen: false, // State untuk mobile menu

                initTheme() {
                    const savedTheme = localStorage.getItem('theme');
                    this.isDark = savedTheme === 'dark';
                },

                toggleTheme() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                }
            }
        }
    </script>

    <div class="flex h-screen w-full relative">

        {{-- 1. OVERLAY / BACKDROP (Hanya muncul di mobile saat sidebar terbuka) --}}
        <div x-show="sidebarOpen" x-transition:enter="transition opacity-ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden">
        </div>

        {{-- 2. ASIDE (SIDEBAR) - Responsif translate --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 flex flex-col border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shrink-0 transition-all duration-300 lg:static lg:inset-auto">

            <div class="flex items-center justify-between px-6 py-6 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-admin-primary text-white">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">EduAdmin</h1>
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-normal">Management Console</p>
                    </div>
                </div>
                {{-- Tombol Close di Sidebar (Hanya Mobile) --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-500">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <nav class="flex flex-col gap-2 p-4 flex-1 overflow-y-auto">
                <div class="flex flex-col gap-1">
                    <p
                        class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2 mt-2">
                        Main</p>

                    @php $role = auth()->user()->role; @endphp

                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg 
                        {{ request()->routeIs('admin.dashboard') ? 'bg-admin-primary/10 text-admin-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} group"
                        href="{{ route('admin.dashboard') }}">
                        <span class="material-symbols-outlined text-[22px]">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    @if ($role === 'admin')
                        {{-- DROPDOWN MANAJEMEN WALI (Menu Anda Tetap Utuh) --}}
                        <div x-data="{ open: {{ request()->routeIs('admin.wali.*') ? 'true' : 'false' }} }" class="flex flex-col gap-1">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all group">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="material-symbols-outlined text-[22px] group-hover:text-blue-600 transition-colors {{ request()->routeIs('admin.wali.*') ? 'text-blue-600' : '' }}">group</span>
                                    <span class="text-sm font-medium">Manajemen Wali</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-[18px] text-slate-400 transition-transform duration-200 cursor-pointer"
                                    :class="open ? 'rotate-180' : ''">expand_more</span>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="flex flex-col gap-1 pl-11 pr-2" style="display: none;">
                                <a href="{{ route('admin.wali.index') }}"
                                    class="block py-2 px-3 text-sm rounded-md transition-colors {{ request()->routeIs('admin.wali.index') ? 'text-blue-600 bg-blue-50 font-semibold dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 dark:text-slate-400' }}">
                                    Menunggu Verifikasi
                                </a>
                                <a href="{{ route('admin.wali.active') }}"
                                    class="block py-2 px-3 text-sm rounded-md transition-colors {{ request()->routeIs('admin.wali.active') ? 'text-blue-600 bg-blue-50 font-semibold dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 dark:text-slate-400' }}">
                                    Wali Murid Aktif
                                </a>
                                <a href="{{ route('admin.wali.rejected') }}"
                                    class="block py-2 px-3 text-sm rounded-md transition-colors {{ request()->routeIs('admin.wali.rejected') ? 'text-blue-600 bg-blue-50 font-semibold dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 dark:text-slate-400' }}">
                                    Pengajuan Ditolak
                                </a>
                            </div>
                        </div>

                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group"
                            href="#">
                            <span
                                class="material-symbols-outlined text-[22px] group-hover:text-admin-primary transition-colors">school</span>
                            <span class="text-sm font-medium">Student Directory</span>
                        </a>

                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.artikel.*') ? 'bg-admin-primary/10 text-admin-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} group"
                            href="{{ route('admin.artikel.index') }}">
                            <span
                                class="material-symbols-outlined text-[22px] group-hover:text-admin-primary transition-colors">article</span>
                            <span class="text-sm font-medium">Article CMS</span>
                        </a>

                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 group"
                            href="#">
                            <span
                                class="material-symbols-outlined text-[22px] group-hover:text-admin-primary transition-colors">book_2</span>
                            <span class="text-sm font-medium">Academic Management</span>
                        </a>
                    @endif

                    @if ($role === 'guru')
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 group"
                            href="#">
                            <span class="material-symbols-outlined text-[22px]">school</span>
                            <span class="text-sm font-medium">Student Directory</span>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.artikel.*') ? 'bg-admin-primary/10 text-admin-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} group"
                            href="{{ route('admin.artikel.index') }}">
                            <span class="material-symbols-outlined text-[22px]">article</span>
                            <span class="text-sm font-medium">Article CMS</span>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 group"
                            href="#">
                            <span class="material-symbols-outlined text-[22px]">book_2</span>
                            <span class="text-sm font-medium">Academic Management</span>
                        </a>
                    @endif
                </div>
            </nav>

            <div class="mt-auto border-t border-slate-100 dark:border-slate-800 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                        <span class="material-symbols-outlined text-[22px]">logout</span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- 3. MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0 h-full relative overflow-hidden">

            <header
                class="h-16 flex items-center justify-between px-4 md:px-6 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    {{-- Tombol Hamburger (Hanya muncul di Mobile) --}}
                    <button @click="sidebarOpen = true"
                        class="p-2 -ml-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg lg:hidden transition-colors">
                        <span class="material-symbols-outlined">menu</span>
                    </button>

                    {{-- Search Bar (Responsive Width) --}}
                    <div class="hidden sm:flex relative group w-48 md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-symbols-outlined text-slate-400 group-focus-within:text-admin-primary transition-colors text-xl">search</span>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-admin-primary/50 transition-all"
                            placeholder="Search..." type="text" />
                    </div>
                </div>

                <div class="flex items-center gap-1 md:gap-2">
                    <button @click="toggleTheme()"
                        class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors">
                        <span class="material-symbols-outlined" x-show="!isDark">dark_mode</span>
                        <span class="material-symbols-outlined" x-show="isDark">light_mode</span>
                    </button>

                    {{-- Profile Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 md:gap-3 p-1 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
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
                            <div class="hidden sm:block text-left leading-tight">
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                    {{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-500 uppercase">{{ Auth::user()->role }}</p>
                            </div>
                            <span
                                class="material-symbols-outlined text-slate-400 text-xl transition-transform cursor-pointer"
                                :class="open ? 'rotate-180' : ''">expand_more</span>
                        </button>

                        <div x-show="open" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-100 dark:border-slate-800 overflow-hidden z-50 py-1">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">
                                <span class="material-symbols-outlined text-[20px]">person</span> Profil Saya
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                    <span class="material-symbols-outlined text-[20px]">logout</span> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Scrollable Area --}}
            <div class="flex-1 overflow-y-auto bg-admin-bg-light dark:bg-admin-bg-dark p-4 md:p-8 scroll-smooth">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">
                    {{ $slot }}
                </div>
            </div>

        </main>
    </div>
</body>

</html>
