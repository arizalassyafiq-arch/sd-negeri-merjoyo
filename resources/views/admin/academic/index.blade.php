<x-admin-layout>
    <x-slot:title>Academic Management</x-slot>

    @php
        $role = auth()->user()->role;
        $indexRouteName = $role === 'guru' ? 'guru.academic.index' : 'admin.academic.index';
        $detailRouteName = $role === 'guru' ? 'guru.academic.students.show' : 'admin.academic.students.show';
    @endphp

    <div class="-m-4 min-h-full bg-main-bg p-8 font-sans text-slate-100 md:-m-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-1">Manajemen Siswa</h2>
            <p class="text-slate-400 text-sm">Total {{ number_format($totalStudents) }} Siswa Terdaftar</p>
        </div>

        <div
            class="bg-slate-800/20 p-1 rounded-xl flex flex-wrap items-center gap-1 mb-6 border border-slate-800/50 w-fit">
            <a href="{{ route($indexRouteName) }}"
                class="px-5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ request('class') ? 'text-slate-400 hover:text-white hover:bg-slate-800/50' : 'bg-blue-600 text-white' }}">
                Semua Kelas
            </a>
            @foreach ($classOptions as $classOption)
                <a href="{{ route($indexRouteName, ['class' => $classOption]) }}"
                    class="px-5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ request('class') === $classOption ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                    {{ $classOption }}
                </a>
            @endforeach
        </div>

        <div class="bg-card-bg border border-slate-800/50 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-slate-500 uppercase text-[10px] font-bold tracking-widest border-b border-slate-800/50">
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">NIS / NIK</th>
                            <th class="px-6 py-4">Kelas</th>
                            <th class="px-6 py-4">Gender</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/30">
                        @forelse ($students as $student)
                            @php
                                $badges = [
                                    'active' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'lulus' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'drop_out' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                    'pindah' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                ];
                                $labels = [
                                    'active' => 'Aktif',
                                    'lulus' => 'Lulus',
                                    'drop_out' => 'Drop Out',
                                    'pindah' => 'Pindah',
                                ];
                            @endphp
                            <tr class="hover:bg-slate-800/10 transition-all">
                                <td class="px-6 py-5">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $student->name }}</p>
                                        @if ($student->guardian)
                                            <p class="text-[10px] text-emerald-400">{{ $student->guardian->name }}</p>
                                        @else
                                            <p class="text-[10px] text-slate-500">Belum ada wali</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-[11px] font-medium text-slate-400">
                                        <p>NIS: {{ $student->nis }}</p>
                                        <p>NIK: {{ $student->nik }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700/50 text-[10px] font-bold text-slate-300">
                                        {{ $student->class_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-xs text-slate-300">
                                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $badges[$student->status] ?? 'bg-slate-500/10 text-slate-300 border-slate-500/20' }}">
                                        {{ $labels[$student->status] ?? ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <a href="{{ route($detailRouteName, $student) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-[11px] font-bold transition-all">
                                        Masuk
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-400">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
