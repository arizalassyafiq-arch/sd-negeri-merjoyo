@forelse ($students as $student)
    @php
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
                <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $student->name }}</span>
                @if ($student->guardian)
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-0.5">
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
                <span class="text-slate-600 dark:text-slate-300">NISN: {{ $student->nisn }}</span>
                <span class="text-slate-400">NIK: {{ $student->nik }}</span>
            </div>
        </td>
        <td class="px-6 py-4">
            <span
                class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[11px] font-bold text-slate-600 dark:text-slate-300">
                {{ $student->classroom->name ?? 'Belum ada kelas' }}
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
            @php
                $detailRouteName =
                    auth()->user()->role === 'guru' ? 'guru.academic.students.show' : 'admin.academic.students.show';
            @endphp
            <a href="{{ route($detailRouteName, $student) }}"
                class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-xl text-[11px] font-bold transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5">
                Masuk
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
            <div class="flex flex-col items-center gap-2">
                <span class="material-symbols-outlined text-4xl text-slate-300">search_off</span>
                <p>Tidak ada data siswa ditemukan.</p>
            </div>
        </td>
    </tr>
@endforelse
