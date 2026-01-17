<x-admin-layout>
    <x-slot:title>Student Directory</x-slot>

    <div class="flex flex-col gap-6">
        @php
            $role = auth()->user()->role;
            $canManageStudents = $role === 'admin';
            $indexRouteName = $role === 'guru' ? 'guru.students.index' : 'admin.students.index';
        @endphp

        @if (session('status'))
            <div
                class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-600 dark:text-emerald-400 font-medium flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('status') }}
            </div>
        @endif

        {{-- Header & Actions --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Manajemen Siswa</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Total {{ number_format($totalStudents) }} Siswa Terdaftar
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 items-center w-full md:w-auto">
                {{-- SEARCH BAR DENGAN ALPINE JS DEBOUNCE --}}
                <form action="{{ route($indexRouteName) }}" method="GET" class="relative w-full sm:w-64">
                    {{-- Pertahankan filter kelas jika ada, agar saat search kelas tidak ter-reset --}}
                    @if (request('class'))
                        <input type="hidden" name="class" value="{{ request('class') }}">
                    @endif

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </span>
                        {{-- 
                            LOGIKA ALPINE:
                            @input.debounce.500ms="$el.form.submit()"
                            Artinya: Tunggu 500ms (setengah detik) setelah user berhenti mengetik, baru submit form.
                        --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            @input.debounce.500ms="$el.form.submit()" placeholder="Cari Nama / NISN..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-shadow"
                            autocomplete="off">
                    </div>
                </form>

                @if ($canManageStudents)
                    <a href="{{ route('admin.students.create') }}"
                        class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition active:scale-95 whitespace-nowrap w-full sm:w-auto">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        Tambah Siswa
                    </a>
                @endif
            </div>
        </div>

        {{-- Filter Kelas --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-2xl p-2 border border-slate-200/60 dark:border-slate-800 shadow-sm flex flex-wrap gap-2">
            <a href="{{ route($indexRouteName, ['search' => request('search')]) }}"
                class="px-5 py-2 rounded-2xl text-sm font-medium transition-all {{ !request('class') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                Semua Kelas
            </a>

            @foreach ($classrooms as $classroom)
                {{-- Tombol Per Kelas (Set filter kelas, pertahankan search) --}}
                <a href="{{ route($indexRouteName, ['class' => $classroom->id, 'search' => request('search')]) }}"
                    class="px-5 py-2 rounded-2xl text-sm font-medium transition-all {{ request('class') == $classroom->id ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                    {{ $classroom->name }}
                </a>
            @endforeach
        </div>

        {{-- Tabel Siswa --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/10 backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
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
                            @if ($canManageStudents)
                                <th
                                    class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/80 dark:divide-slate-800">
                        @forelse ($students as $student)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="whitespace-nowrap font-bold text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">{{ $student->name }}</span>
                                        @if ($student->guardian)
                                            <span
                                                class=" text-xs text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-0.5">
                                                <span class="material-symbols-outlined text-[12px]">family_link</span>
                                                Wali: {{ $student->guardian->name }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 italic mt-0.5">Belum ada wali</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col text-sm">
                                        <span
                                            class="text-slate-600 dark:text-slate-300 font-medium">{{ $student->nisn }}</span>
                                        <span class="text-xs text-slate-400 whitespace-nowrap">NIK:
                                            {{ $student->nik }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 whitespace-nowrap rounded-lg bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                        {{ $student->classroom->name ?? 'Non-Kelas' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-300">
                                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $badges = [
                                            'active' =>
                                                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20',
                                            'lulus' =>
                                                'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20',
                                            'drop_out' =>
                                                'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
                                            'pindah' =>
                                                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
                                        ];
                                        $labels = [
                                            'active' => 'Aktif',
                                            'lulus' => 'Lulus',
                                            'drop_out' => 'Drop Out',
                                            'pindah' => 'Pindah',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $badges[$student->status] ?? 'bg-slate-100 text-slate-500 border-slate-200' }}">
                                        {{ $labels[$student->status] ?? ucfirst($student->status) }}
                                    </span>
                                </td>
                                @if ($canManageStudents)
                                    <td class="px-6 py-5">
                                        {{-- 
            PERBAIKAN RESPONSIVE:
            1. opacity-100 : Di HP tombol selalu terlihat (karena tidak ada mouse).
            2. md:opacity-0 : Di Laptop (layar medium ke atas), tombol sembunyi dulu.
            3. md:group-hover:opacity-100 : Di Laptop, tombol baru muncul saat baris disorot mouse.
        --}}
                                        <div
                                            class="flex items-center justify-end gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-200">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                                class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all"
                                                title="Edit Siswa">
                                                <span class="material-symbols-outlined text-[20px]">edit_square</span>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <form method="POST"
                                                action="{{ route('admin.students.destroy', $student) }}"
                                                onsubmit="return confirm('Hapus data siswa ini? Data tidak dapat dikembalikan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all"
                                                    title="Hapus Siswa">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $canManageStudents ? 6 : 5 }}" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div
                                            class="h-16 w-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300">
                                            <span class="material-symbols-outlined text-4xl">search_off</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-slate-900 dark:text-white font-medium">Tidak ada data siswa
                                                ditemukan.</p>
                                            <p class="text-slate-500 text-sm mt-1">Coba ubah kata kunci pencarian atau
                                                filter kelas.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($students->hasPages())
                <div
                    class="px-6 py-4 border-t border-slate-100/80 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                    {{ $students->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
