<x-admin-layout>
    <x-slot:title>Academic Management</x-slot>

    @php
        $role = auth()->user()->role;
        $indexRouteName = $role === 'guru' ? 'guru.academic.index' : 'admin.academic.index';
    @endphp

    {{-- 
        x-data Logic:
        1. search: menyimpan text inputan
        2. performSearch(): fungsi untuk request ke server
    --}}
    <div class="flex flex-col gap-6 font-sans" x-data="{
        search: '{{ request('search') }}',
        async performSearch() {
            // Buat URL dengan parameter search & class (jika ada)
            let params = new URLSearchParams(window.location.search);
            params.set('search', this.search);
    
            // Fetch ke server
            // Header 'X-Requested-With': 'XMLHttpRequest' PENTING agar Controller tau ini AJAX
            let response = await fetch('{{ route($indexRouteName) }}?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
    
            // Ambil HTML dari server dan pasang di tbody
            let html = await response.text();
            document.getElementById('students-table-body').innerHTML = html;
    
            // Update URL browser tanpa refresh (opsional, agar kalau direfresh search tidak hilang)
            window.history.pushState({}, '', '?' + params.toString());
        }
    }">

        {{-- Header Section --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Manajemen Akademik</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Total {{ number_format($totalStudents) }} Siswa Terdaftar
                </p>
            </div>

            {{-- SEARCH BAR (Live Search) --}}
            <div class="w-full md:w-auto">
                <div class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </span>

                    {{-- Input Alpine --}}
                    <input type="text" x-model="search" @input.debounce.500ms="performSearch()"
                        placeholder="Cari Nama / NISN..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-shadow">
                </div>
            </div>
        </div>

        {{-- Filter Kelas (Tetap menggunakan link biasa / refresh page agar logic sederhana) --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-2xl p-2 border border-slate-200/60 dark:border-slate-800 shadow-sm flex flex-wrap gap-2 w-fit">
            <a href="{{ route($indexRouteName) }}"
                class="px-5 py-2 rounded-xl text-xs font-bold transition-all {{ !request('class') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                Semua Kelas
            </a>
            @foreach ($classrooms as $classroom)
                <a href="{{ route($indexRouteName, ['class' => $classroom->id]) }}"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all {{ request('class') == $classroom->id ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                    {{ $classroom->name }}
                </a>
            @endforeach
        </div>

        {{-- Tabel Siswa --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/70 dark:bg-slate-800/60 border-b border-slate-200/60 dark:border-slate-800">
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Siswa
                            </th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">NISN / NIK
                            </th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Kelas</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Gender</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            <th
                                class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">
                                Aksi</th>
                        </tr>
                    </thead>

                    {{-- Tambahkan ID disini untuk target replace AJAX --}}
                    <tbody id="students-table-body" class="divide-y divide-slate-100/80 dark:divide-slate-800">
                        {{-- Include Partial View --}}
                        @include('admin.academic.partials.table_rows')
                    </tbody>
                </table>
            </div>

            {{-- Pagination (Perhatian: Link pagination ini masih akan me-refresh halaman jika diklik) --}}
            @if (method_exists($students, 'links') && $students->hasPages())
                <div class="px-6 py-4 border-t border-slate-100/80 dark:border-slate-800">
                    {{ $students->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
