<x-admin-layout>
    <x-slot:title>Dashboard Overview</x-slot>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Dashboard Overview</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Halo {{ Auth::user()->name ?? 'Admin' }}, inilah statistik
                sekolah
                hari ini.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div
            class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-200/60 dark:border-slate-700">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-admin-primary">
                    <span class="material-symbols-outlined text-2xl">school</span>
                </div>
                <span
                    class="flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    <span class="material-symbols-outlined text-sm">trending_up</span> +5%
                </span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Total Siswa</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalSiswa }}</p>
            <p class="text-xs text-slate-400 mt-2">Data semester ini</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-200/60 dark:border-slate-700">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600">
                    <span class="material-symbols-outlined text-2xl">article</span>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Artikel Terbit</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalArtikel }}</p>
            <p class="text-xs text-slate-400 mt-2">Blog & Berita</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-200/60 dark:border-slate-700">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Total Orang Tua</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalOrangTua }}</p>
            <p class="text-xs text-slate-400 mt-2">Semua Pengguna</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-orange-200 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-16 h-16 bg-linear-to-br from-orange-100/50 to-transparent rounded-bl-full -mr-4 -mt-4">
            </div>
            <div class="flex items-start justify-between mb-4 relative z-10">
                <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-medium relative z-10">Pending Pengguna</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1 relative z-10">{{ $totalPending }}</p>
            <p class="text-xs text-orange-600 mt-2 font-medium relative z-10">Butuh Verifikasi</p>
        </div>
    </div>

</x-admin-layout>
