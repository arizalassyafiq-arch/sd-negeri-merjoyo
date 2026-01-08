<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? 'EduAdmin Dashboard' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-admin bg-admin-bg-light dark:bg-admin-bg-dark text-slate-900 dark:text-slate-100 antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        <aside
            class="flex w-72 flex-col border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shrink-0 transition-all duration-300">
            <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-admin-primary text-white">
                    <span class="material-symbols-outlined">school</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">EduAdmin</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-xs font-normal">Management Console</p>
                </div>
            </div>

            <nav class="flex flex-col gap-2 p-4 flex-1 overflow-y-auto">
                <div class="flex flex-col gap-1">
                    <p
                        class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2 mt-2">
                        Main</p>

                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-admin-primary/10 text-admin-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} group"
                        href="{{ route('admin.dashboard') }}">
                        <span
                            class="material-symbols-outlined text-[22px] {{ request()->routeIs('admin.dashboard') ? 'admin-icon-filled' : '' }}">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group"
                        href="#">
                        <span
                            class="material-symbols-outlined text-[22px] group-hover:text-admin-primary transition-colors">group</span>
                        <span class="text-sm font-medium">User Management</span>
                    </a>

                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.artikel.*') ? 'bg-admin-primary/10 text-admin-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} group"
                        href="{{ route('admin.artikel.index') }}">
                        <span
                            class="material-symbols-outlined text-[22px] group-hover:text-admin-primary transition-colors {{ request()->routeIs('admin.artikel.*') ? 'admin-icon-filled' : '' }}">article</span>
                        <span class="text-sm font-medium">Article CMS</span>
                    </a>
                </div>
            </nav>

            <div class="mt-auto border-t border-slate-100 dark:border-slate-800 p-4">
                <form method="POST" action="#">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors group">
                        <span class="material-symbols-outlined text-[22px]">logout</span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-full relative overflow-hidden">

            <header
                class="h-16 flex items-center justify-between px-6 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="text-slate-500 hover:text-slate-700 lg:hidden">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="hidden md:flex relative group w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-symbols-outlined text-slate-400 group-focus-within:text-admin-primary transition-colors text-xl">search</span>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-admin-primary/50 focus:border-admin-primary sm:text-sm transition-all duration-200"
                            placeholder="Search..." type="text" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center gap-3 cursor-pointer p-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-colors">
                        <div
                            class="w-8 h-8 rounded-full bg-admin-primary text-white flex items-center justify-center font-bold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                {{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ ucfirst(Auth::user()->role ?? 'User') }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto bg-admin-bg-light dark:bg-admin-bg-dark p-6 md:p-8 scroll-smooth">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">
                    {{ $slot }}
                </div>
            </div>

        </main>
    </div>
</body>

</html>
