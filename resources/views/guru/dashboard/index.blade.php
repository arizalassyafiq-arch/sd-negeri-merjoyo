<x-admin-layout>
    <x-slot:title>Ruang Guru</x-slot>

    {{-- Welcome Banner --}}
    <div
        class="relative overflow-hidden rounded-3xl bg-admin-primary p-8 text-white shadow-xl shadow-admin-primary/20 mb-8">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold tracking-tight">Selamat Pagi, {{ Auth::user()->name }}! 🌤️</h2>
                <p class="mt-2 text-blue-100 text-lg">Siap menginspirasi siswa hari ini? Cek perkembangan kelasmu.</p>
                <div class="mt-6 flex gap-3">
                    {{-- Tombol Aksi Cepat: Mengarah ke Akademik --}}
                    <a href="#"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-admin-primary transition hover:bg-blue-50">
                        <span class="material-symbols-outlined">edit_square</span>
                        Input Nilai
                    </a>
                    <a href="#"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600/30 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-600/40 backdrop-blur-sm">
                        <span class="material-symbols-outlined">fact_check</span>
                        Absensi
                    </a>
                </div>
            </div>
            {{-- Illustrasi Dekoratif --}}
            <div class="hidden md:block">
                <span class="material-symbols-outlined text-[120px] text-white/10 rotate-12">school</span>
            </div>
        </div>

        {{-- Pattern Background --}}
        <div class="absolute top-0 right-0 -mt-10 -mr-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 h-64 w-64 rounded-full bg-blue-900/20 blur-3xl"></div>
    </div>

    {{-- Statistik Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card 1: Siswa --}}
        <div
            class="bg-white dark:bg-slate-900/60 p-6 rounded-3xl border border-slate-200/60 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div
                class="h-14 w-14 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <span class="material-symbols-outlined text-3xl">groups</span>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Siswa Diampu</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $totalSiswaKelolaan }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></p>
            </div>
        </div>

        {{-- Card 2: Materi --}}
        <div
            class="bg-white dark:bg-slate-900/60 p-6 rounded-3xl border border-slate-200/60 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div
                class="h-14 w-14 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <span class="material-symbols-outlined text-3xl">topic</span>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Target Belajar</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $totalMateri }} <span
                        class="text-sm font-normal text-slate-400">Topik</span></p>
            </div>
        </div>

        {{-- Card 3: Absen Hari Ini --}}
        <div
            class="bg-white dark:bg-slate-900/60 p-6 rounded-3xl border border-slate-200/60 dark:border-slate-800 shadow-sm flex items-center gap-4">
            <div
                class="h-14 w-14 rounded-2xl bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <span class="material-symbols-outlined text-3xl">sick</span>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Tidak Masuk</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $siswaSakit + $siswaIzin }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Section Kiri: Jadwal / Quick Access --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Shortcut Menu --}}
            <div
                class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Aktivitas Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#"
                        class="group flex flex-col items-center gap-3 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-white hover:shadow-lg hover:shadow-slate-200/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-12 w-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">add_task</span>
                        </div>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300">Input Nilai</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center gap-3 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-white hover:shadow-lg hover:shadow-slate-200/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-12 w-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">history_edu</span>
                        </div>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300">Buat Target</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center gap-3 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-white hover:shadow-lg hover:shadow-slate-200/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-12 w-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">event_note</span>
                        </div>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300">Jadwal Ajar</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center gap-3 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-white hover:shadow-lg hover:shadow-slate-200/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-12 w-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">forum</span>
                        </div>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300">Pesan Wali</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Section Kanan: Siswa Terbaru / Notifikasi --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 p-6 h-fit">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Siswa Terbaru</h3>
                <a href="#" class="text-xs font-bold text-admin-primary hover:underline">Lihat Semua</a>
            </div>

            <div class="space-y-4">
                @forelse($recentStudents as $student)
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer group">
                        <div
                            class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 text-xs font-bold">
                            {{ substr($student->name, 0, 2) }}
                        </div>
                        <div class="flex-1">
                            <p
                                class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-admin-primary transition-colors">
                                {{ $student->name }}
                            </p>
                            <p class="text-[10px] text-slate-500">{{ $student->class_name }}</p>
                        </div>
                        {{-- FIX: Link ke detail siswa yang benar --}}
                        <a href="#"
                            class="h-8 w-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-admin-primary hover:text-white hover:border-admin-primary transition-all">
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data siswa.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-admin-layout>
