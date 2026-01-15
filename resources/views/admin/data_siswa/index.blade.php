<x-admin-layout>
    <x-slot:title>Student Directory</x-slot>

    <div class="flex flex-col gap-6">
        @php
            $role = auth()->user()->role;
            $canManageStudents = $role === 'admin';
            $indexRouteName = $role === 'guru' ? 'guru.students.index' : 'admin.students.index';
        @endphp

        @if (session('status'))
            <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">Manajemen Siswa</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Total {{ number_format($totalStudents) }} Siswa Terdaftar
                </p>
            </div>
            @if ($canManageStudents)
                <a href="{{ route('admin.students.create') }}"
                    class="inline-flex items-center gap-2 bg-admin-primary hover:bg-admin-primary-hover text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-500/20 transition active:scale-95">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Tambah Siswa Baru
                </a>
            @endif
        </div>

        {{-- Filter Kelas (Updated to use Database Classrooms) --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-2xl p-2 border border-slate-200/60 dark:border-slate-800 shadow-sm flex flex-wrap gap-2">
            <a href="{{ route($indexRouteName) }}"
                class="px-5 py-2 rounded-2xl text-sm font-medium transition-all {{ !request('class') ? 'bg-admin-primary text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                Semua Kelas
            </a>
            @foreach ($classrooms as $classroom)
                <a href="{{ route($indexRouteName, ['class' => $classroom->id]) }}"
                    class="px-5 py-2 rounded-2xl text-sm font-medium transition-all {{ request('class') == $classroom->id ? 'bg-admin-primary text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                    {{ $classroom->name }}
                </a>
            @endforeach
        </div>

        {{-- Tabel Siswa --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50/70 dark:bg-slate-800/60 border-b border-slate-200/60 dark:border-slate-800">
                            <th class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest">Nama
                                Siswa</th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest">NIS /
                                NIK</th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest">Kelas
                            </th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest">Gender
                            </th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest">Status
                            </th>
                            @if ($canManageStudents)
                                <th
                                    class="px-6 py-5 text-xs font-semibold text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/80 dark:divide-slate-800">
                        @forelse ($students as $student)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-semibold text-slate-900 dark:text-white">{{ $student->name }}</span>
                                        @if ($student->guardian)
                                            <span class="text-xs text-emerald-500 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[10px]">link</span>
                                                {{ $student->guardian->name }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Belum ada wali</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col text-sm">
                                        <span class="text-slate-600 dark:text-slate-300">NISN:
                                            {{ $student->nisn }}</span>
                                        <span class="text-xs text-slate-500">NIK: {{ $student->nik }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    {{-- Updated to use relation --}}
                                    <span
                                        class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-semibold text-slate-600 dark:text-slate-300">
                                        {{ $student->classroom->name ?? 'Belum Masuk Kelas' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $badges = [
                                            'active' => 'bg-emerald-500/15 text-emerald-400',
                                            'lulus' => 'bg-blue-500/15 text-blue-400',
                                            'drop_out' => 'bg-rose-500/15 text-rose-400',
                                            'pindah' => 'bg-amber-500/15 text-amber-400',
                                        ];
                                        $labels = [
                                            'active' => 'Aktif',
                                            'lulus' => 'Lulus',
                                            'drop_out' => 'Drop Out',
                                            'pindah' => 'Pindah',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full {{ $badges[$student->status] ?? 'bg-gray-500/15 text-gray-400' }} text-xs font-semibold">
                                        {{ $labels[$student->status] ?? ucfirst($student->status) }}
                                    </span>
                                </td>
                                @if ($canManageStudents)
                                    <td class="px-6 py-5">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- TOMBOL EDIT --}}
                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                                class="p-2 rounded-xl text-slate-400 hover:text-admin-primary hover:bg-admin-primary/10 transition-all">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </a>

                                            {{-- TOMBOL DELETE --}}
                                            <form method="POST"
                                                action="{{ route('admin.students.destroy', $student) }}"
                                                onsubmit="return confirm('Hapus data siswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition-all">
                                                    <span class="material-symbols-outlined text-lg">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $canManageStudents ? 6 : 5 }}"
                                    class="px-6 py-16 text-center text-slate-500 dark:text-slate-400">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($students->hasPages())
                <div class="px-6 py-4 border-t border-slate-100/80 dark:border-slate-800">
                    {{ $students->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
