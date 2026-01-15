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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        {{-- Card 1: Siswa Hadir --}}
        {{-- Icon: how_to_reg (Orang dengan centang/verifikasi) --}}
        {{-- Warna: Emerald (Hijau Segar) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                <span class="material-symbols-outlined text-3xl">how_to_reg</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Siswa Hadir</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $siswaHadir ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></h3>
            </div>
        </div>

        {{-- Card 2: Siswa Sakit --}}
        {{-- Icon: thermometer (Suhu tubuh/Kesehatan) --}}
        {{-- Warna: Amber (Kuning/Peringatan) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500">
                <span class="material-symbols-outlined text-3xl">thermometer</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Siswa Sakit</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $siswaSakit ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></h3>
            </div>
        </div>

        {{-- Card 3: Siswa Izin --}}
        {{-- Icon: assignment (Lambang surat/dokumen izin) --}}
        {{-- Warna: Blue (Biru Langit/Info) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <span class="material-symbols-outlined text-3xl">assignment</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Siswa Izin</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $siswaIzin ?? 0 }} <span
                        class="text-sm font-normal text-slate-400">Anak</span></h3>
            </div>
        </div>

        {{-- Card 4: Siswa Alpa --}}
        {{-- Icon: person_off (Orang hilang/dicoret) --}}
        {{-- Warna: Rose (Merah/Danger) --}}
        <div
            class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:-translate-y-1 hover:shadow-md">
            <div class="h-16 w-16 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500">
                <span class="material-symbols-outlined text-3xl">person_off</span>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Siswa Alpa</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $siswaAlpa ?? 0 }} <span
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

                <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                    {{-- 1. Input Nilai (Link ke Capaian Siswa) --}}
                    <a href="{{ route('guru.artikel.index') }}"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">article</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600">Buat Artikel</span>
                    </a>

                    {{-- 2. Buat Target (Link ke Tujuan Pembelajaran) --}}
                    <a href="{{ route('guru.academic.index') }}"
                        class="group flex flex-col items-center gap-4 p-4 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50 transition-all border border-transparent hover:border-slate-100">
                        <div
                            class="h-14 w-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-2xl">history_edu</span>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-emerald-600">Academic
                            Manage</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- KANAN: Siswa Terbaru (Sidebar) --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm h-fit">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Siswa Terbaru</h3>
                {{-- Link Lihat Semua juga bisa dibuat dinamis --}}
                <a href="{{ auth()->user()->role === 'guru' ? route('guru.academic.index') : route('admin.academic.index') }}"
                    class="text-xs font-bold text-[#6366F1] hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="space-y-4">
                {{-- Loop Data Siswa --}}
                @forelse($recentStudents as $student)
                    @php
                        // Logika Dinamis: Cek role user untuk menentukan tujuan link
                        // Jika Guru -> ke route guru, Jika Admin -> ke route admin
                        $routePrefix = auth()->user()->role === 'guru' ? 'guru' : 'admin';
                        $detailRoute = $routePrefix . '.academic.students.show';
                    @endphp

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
                                {{-- Pastikan menggunakan relasi classroom --}}
                                {{ $student->classroom->name ?? 'Belum masuk kelas' }}
                            </p>
                        </div>

                        {{-- Button Arrow (LINK PERBAIKAN DI SINI) --}}
                        <a href="{{ route($detailRoute, $student) }}"
                            class="h-8 w-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-[#6366F1] hover:text-white hover:border-[#6366F1] transition-all"
                            title="Lihat Detail Akademik">
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
