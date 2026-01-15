<x-admin-layout>
    <x-slot:title>Academic Management</x-slot>

    @php
        $role = auth()->user()->role;
        // Logika routing dari Code 1 tetap dipertahankan
        $indexRouteName = $role === 'guru' ? 'guru.academic.index' : 'admin.academic.index';
        $detailRouteName = $role === 'guru' ? 'guru.academic.students.show' : 'admin.academic.students.show';
    @endphp

    <div class="flex flex-col gap-6 font-sans">

        {{-- Header Section --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Manajemen Siswa</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Total {{ number_format($totalStudents) }} Siswa Terdaftar
                </p>
            </div>

            {{-- Jika ingin menambahkan tombol aksi global di sini bisa ditaruh --}}
        </div>

        {{-- Filter Kelas (Style Code 2) --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-2xl p-2 border border-slate-200/60 dark:border-slate-800 shadow-sm flex flex-wrap gap-2 w-fit">
            <a href="{{ route($indexRouteName) }}"
                class="px-5 py-2 rounded-xl text-xs font-bold transition-all {{ request('class') ? 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' : 'bg-blue-600 text-white shadow-md shadow-blue-500/20' }}">
                Semua Kelas
            </a>
            @foreach ($classOptions as $classOption)
                <a href="{{ route($indexRouteName, ['class' => $classOption]) }}"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all {{ request('class') === $classOption ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}">
                    {{ $classOption }}
                </a>
            @endforeach
        </div>

        {{-- Tabel Siswa (Style Code 2, Logic Code 1) --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
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
                    <tbody class="divide-y divide-slate-100/80 dark:divide-slate-800">
                        @forelse ($students as $student)
                            @php
                                // Logic Badge warna tetap, tapi style css diperhalus
                                $badges = [
                                    'active' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400',
                                    'lulus' => 'bg-blue-500/15 text-blue-600 dark:text-blue-400',
                                    'drop_out' => 'bg-rose-500/15 text-rose-600 dark:text-rose-400',
                                    'pindah' => 'bg-amber-500/15 text-amber-600 dark:text-amber-400',
                                ];
                                $labels = [
                                    'active' => 'Aktif',
                                    'lulus' => 'Lulus',
                                    'drop_out' => 'Drop Out',
                                    'pindah' => 'Pindah',
                                ];
                            @endphp
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-slate-900 dark:text-white text-sm">{{ $student->name }}</span>
                                        @if ($student->guardian)
                                            <span
                                                class="text-[11px] text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-0.5">
                                                <span class="material-symbols-outlined text-[12px]">link</span>
                                                {{ $student->guardian->name }}
                                            </span>
                                        @else
                                            <span class="text-[11px] text-slate-400 italic mt-0.5">Belum ada wali</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-[11px] font-medium">
                                        <span class="text-slate-600 dark:text-slate-300">NISN:
                                            {{ $student->nisn }}</span>
                                        <span class="text-slate-400">NIK: {{ $student->nik }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[11px] font-bold text-slate-600 dark:text-slate-300">
                                        {{ $student->class_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600 dark:text-slate-300">
                                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold {{ $badges[$student->status] ?? 'bg-slate-500/15 text-slate-500' }}">
                                        {{ $labels[$student->status] ?? ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{-- Aksi 'Masuk' dipertahankan tapi di-style ulang agar cocok dengan tema baru --}}
                                    <a href="{{ route($detailRouteName, $student) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-xl text-[11px] font-bold transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5">
                                        Masuk
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <span
                                            class="material-symbols-outlined text-4xl text-slate-300">folder_off</span>
                                        <p>Belum ada data siswa.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination jika diperlukan --}}
            @if (method_exists($students, 'links') && $students->hasPages())
                <div class="px-6 py-4 border-t border-slate-100/80 dark:border-slate-800">
                    {{ $students->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
