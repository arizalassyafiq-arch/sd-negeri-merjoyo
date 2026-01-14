<x-admin-layout>
    <x-slot:title>Dashboard Guru</x-slot>

    {{-- 
      SECTION 1: WELCOME BANNER 
      Sesuai gambar image_e396af.png (Background Ungu)
    --}}
    <div class="relative overflow-hidden rounded-3xl bg-[#6366F1] p-8 text-white shadow-xl shadow-indigo-200 mb-8">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                {{-- Nama user dinamis --}}
                <h2 class="text-3xl font-bold tracking-tight">Selamat Pagi, {{ Auth::user()->name }}! 🌤️</h2>
                <p class="mt-2 text-indigo-100 text-lg">Siap menginspirasi siswa hari ini? Cek perkembangan kelasmu.</p>

                <div class="mt-6 flex gap-3">
                    {{-- Tombol sesuai fitur di Detail Siswa (Capaian/Nilai) --}}
                    <a href="#"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-[#6366F1] transition hover:bg-indigo-50 shadow-sm">
                        <span class="material-symbols-outlined">edit_square</span>
                        Input Nilai
                    </a>

                    {{-- Tombol sesuai fitur di Detail Siswa (Rekap Absen) --}}
                    <a href="#"
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-500/30 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-500/50 backdrop-blur-sm border border-indigo-400/30">
                        <span class="material-symbols-outlined">fact_check</span>
                        Absensi
                    </a>
                </div>
            </div>

            {{-- Illustrasi Topi Toga (Dekoratif) --}}
            <div class="hidden md:block opacity-20">
                <span class="material-symbols-outlined text-[140px] -rotate-12">school</span>
            </div>
        </div>

        {{-- Background Pattern (Lingkaran blur) --}}
        <div class="absolute top-0 right-0 -mt-10 -mr-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 h-64 w-64 rounded-full bg-indigo-900/20 blur-3xl"></div>
    </div>

    {{-- 
      SECTION 2: STATISTIK RINGKAS
      Disesuaikan dengan kebutuhan Guru (Bukan CMS/Artikel)
    --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Card 1: Siswa Diampu (Sesuai Image Manajemen Siswa) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-[#EEF2FF] flex items-center justify-center text-[#6366F1]">
                <span class="material-symbols-outlined text-3xl">groups</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Siswa Diampu</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $totalSiswa ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></h3>
            </div>
        </div>

        {{-- Card 2: Target Belajar (Sesuai Image Detail Siswa > Tujuan Pembelajaran) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-[#ECFDF5] flex items-center justify-center text-[#10B981]">
                <span class="material-symbols-outlined text-3xl">topic</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Target Belajar</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $totalTarget ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Topik</span></h3>
            </div>
        </div>

        {{-- Card 3: Tidak Masuk (Sesuai Image Detail Siswa > Rekap Absen) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-[#FFF1F2] flex items-center justify-center text-[#F43F5E]">
                <span class="material-symbols-outlined text-3xl">sick</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Tidak Masuk</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $siswaAbsen ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></h3>
            </div>
        </div>
    </div>

    {{-- 
      SECTION 3: LAYOUT SPLIT (Aktivitas & Siswa Terbaru) 
    --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KIRI: Aktivitas Cepat (Shortcut Menu) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm h-full">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Aktivitas Cepat</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    {{-- 1. Input Nilai (Link ke Capaian Siswa) --}}
                    <a href="#"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">add_task</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600">Input Nilai</span>
                    </a>

                    {{-- 2. Buat Target (Link ke Tujuan Pembelajaran) --}}
                    <a href="#"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">history_edu</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-emerald-600">Buat Target</span>
                    </a>

                    {{-- 3. Jadwal Ajar (Umum untuk Guru) --}}
                    <a href="#"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">calendar_month</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-amber-600">Jadwal Ajar</span>
                    </a>

                    {{-- 4. Pesan Wali / Catatan Guru (Link ke Catatan Guru) --}}
                    <a href="#"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-purple-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">forum</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-purple-600">Pesan Wali</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- KANAN: Siswa Terbaru (Sidebar) --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm h-fit">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Siswa Terbaru</h3>
                <a href="#" class="text-xs font-bold text-[#6366F1] hover:underline">Lihat Semua</a>
            </div>

            <div class="space-y-4">
                {{-- Loop Data Siswa --}}
                @forelse($recentStudents as $student)
                    <div
                        class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors cursor-pointer group border border-transparent hover:border-slate-100">
                        {{-- Avatar Inisial --}}
                        <div
                            class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-sm font-bold uppercase">
                            {{ substr($student->name, 0, 2) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <p
                                class="text-sm font-bold text-slate-800 truncate group-hover:text-[#6366F1] transition-colors">
                                {{ $student->name }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ $student->kelas ?? 'Kelas -' }}
                            </p>
                        </div>

                        {{-- Button Arrow --}}
                        <a href="#"
                            class="h-8 w-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-[#6366F1] hover:text-white hover:border-[#6366F1] transition-all">
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-slate-300 text-4xl mb-2">person_off</span>
                        <p class="text-sm text-slate-400">Belum ada data siswa.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-admin-layout>
