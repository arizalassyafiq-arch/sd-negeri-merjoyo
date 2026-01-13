<x-admin-layout>
    <x-slot:title>Detail Akademik</x-slot>

    @php
        $role = auth()->user()->role;
        $indexRouteName = $role === 'guru' ? 'guru.academic.index' : 'admin.academic.index';
        $canEdit = $role === 'admin';
        $attendanceStoreRoute = $role === 'guru' ? 'guru.academic.students.attendance.store' : 'admin.academic.students.attendance.store';
        $goalStoreRoute = $role === 'guru' ? 'guru.academic.students.goals.store' : 'admin.academic.students.goals.store';
        $outcomeStoreRoute = $role === 'guru' ? 'guru.academic.students.outcomes.store' : 'admin.academic.students.outcomes.store';
        $noteStoreRoute = $role === 'guru' ? 'guru.academic.students.notes.store' : 'admin.academic.students.notes.store';
        $goalIconSet = ['functions', 'translate', 'science', 'history_edu'];
        $goalColorSet = [
            ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-500'],
            ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-500'],
            ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-500'],
            ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-500'],
        ];
        $statusTextClass = [
            'COMPLETED' => 'text-emerald-500',
            'ON TRACK' => 'text-purple-500',
            'IN REVIEW' => 'text-blue-500',
            'STARTED' => 'text-amber-500',
        ];
        $statusBarClass = [
            'COMPLETED' => 'bg-emerald-500',
            'ON TRACK' => 'bg-purple-500',
            'IN REVIEW' => 'bg-blue-500',
            'STARTED' => 'bg-amber-500',
        ];
    @endphp

    <div class="flex flex-col gap-6">
        <div class="mb-2">
            <nav class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                <a href="{{ route($indexRouteName) }}" class="text-admin-primary hover:underline">
                    Detail Akademik
                </a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span>{{ $student->class_name ?? '-' }}</span>
            </nav>
            @if (session('status'))
                <div
                    class="mt-4 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                        Detail Siswa: {{ $student->name }}
                    </h2>
                    <p class="mt-1 text-sm uppercase tracking-widest text-slate-500">
                        NIS: {{ $student->nis }} - NIK: {{ $student->nik }}
                    </p>
                </div>
                @if ($canEdit)
                    <a href="{{ route('admin.students.edit', $student) }}"
                        class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Edit Profil
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div
                class="col-span-12 lg:col-span-3 rounded-3xl border border-slate-200/60 bg-white/70 p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Rekap Absen</h3>
                    <button
                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-admin-primary/10 text-admin-primary transition hover:bg-admin-primary hover:text-white"
                        data-modal-target="attendance-modal"
                        type="button">
                        <span class="material-symbols-outlined text-sm">add</span>
                    </button>
                </div>
                <div
                    class="mb-6 inline-flex items-center rounded-full bg-emerald-500/10 px-2 py-0.5 text-[9px] font-bold text-emerald-500">
                    {{ $attendance['rate'] }}% HADIR
                </div>
                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Hadir</p>
                        <span class="text-lg font-bold text-emerald-500">{{ $attendance['present'] }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Sakit</p>
                        <span class="text-lg font-bold text-orange-500">{{ $attendance['sick'] }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Izin</p>
                        <span class="text-lg font-bold text-blue-500">{{ $attendance['permit'] }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Alpha</p>
                        <span class="text-lg font-bold text-rose-500">{{ $attendance['absent'] }}</span>
                    </div>
                </div>
                <button
                    class="mt-4 flex items-center text-[10px] font-bold uppercase text-slate-400 transition hover:text-admin-primary"
                    data-modal-target="attendance-modal"
                    type="button">
                    <span class="material-symbols-outlined text-xs mr-1">edit_note</span>
                    Update Absensi
                </button>
            </div>

            <div
                class="col-span-12 lg:col-span-9 rounded-3xl border border-slate-200/60 bg-white/70 p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tujuan Pembelajaran</h3>
                        <p class="text-xs text-slate-500">Target capaian akademik {{ $student->name }} semester ini</p>
                    </div>
                    <button
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-admin-primary/10 text-admin-primary transition hover:bg-admin-primary hover:text-white"
                        data-modal-target="goal-modal"
                        type="button">
                        <span class="material-symbols-outlined text-lg">add</span>
                    </button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @forelse ($goalCards as $index => $goal)
                        @php
                            $palette = $goalColorSet[$index % count($goalColorSet)];
                            $icon = $goalIconSet[$index % count($goalIconSet)];
                            $statusClass = $statusTextClass[$goal['status']] ?? 'text-slate-400';
                            $barClass = $statusBarClass[$goal['status']] ?? 'bg-slate-500';
                            $description = $goal['description'] ?: 'Target capaian belum diisi.';
                        @endphp
                        <div
                            class="flex items-center gap-4 rounded-2xl border border-transparent bg-slate-50 p-4 transition hover:border-slate-200 dark:bg-slate-800/30 dark:hover:border-slate-700">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl {{ $palette['bg'] }} {{ $palette['text'] }} flex-shrink-0">
                                <span class="material-symbols-outlined">{{ $icon }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="mb-1 flex items-end justify-between gap-2">
                                    <h4 class="truncate text-sm font-bold text-slate-900 dark:text-white">
                                        {{ $goal['title'] }}
                                    </h4>
                                    <span class="text-[9px] font-bold uppercase {{ $statusClass }} flex-shrink-0">
                                        {{ $goal['status'] }}
                                    </span>
                                </div>
                                <p class="mb-2 truncate text-[11px] text-slate-500">{{ $description }}</p>
                                <div class="h-1.5 w-full rounded-full bg-slate-200 dark:bg-slate-700">
                                    <div class="h-1.5 rounded-full {{ $barClass }}"
                                        style="width: {{ $goal['progress'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                            Belum ada tujuan pembelajaran untuk kelas ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div
                class="col-span-12 lg:col-span-8 rounded-3xl border border-slate-200/60 bg-white/70 p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Capaian Siswa</h3>
                        <p class="text-xs text-slate-500">Rincian nilai dan progres per mata pelajaran</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-slate-400 transition hover:text-slate-600 dark:hover:text-slate-200"
                            type="button">
                            <span class="material-symbols-outlined">filter_list</span>
                        </button>
                        <button
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-admin-primary text-white transition hover:bg-admin-primary-hover"
                            data-modal-target="outcome-modal"
                            type="button">
                            <span class="material-symbols-outlined text-lg">add</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:border-slate-800">
                                <th class="pb-4">Mata Pelajaran</th>
                                <th class="pb-4">Catatan</th>
                                <th class="pb-4">Progres</th>
                                <th class="pb-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse ($outcomes as $outcome)
                                @php
                                    $subject = $outcome->goal->title ?? '-';
                                    $abbr = strtoupper(preg_replace('/[^A-Za-z]/', '', $subject));
                                    $abbr = $abbr !== '' ? substr($abbr, 0, 3) : 'N/A';
                                    $score = $outcome->score;
                                    $scoreValue = is_numeric($score) ? (int) $score : null;
                                    if ($scoreValue !== null) {
                                        if ($scoreValue >= 90) {
                                            $label = 'Istimewa';
                                            $labelClass = 'bg-cyan-500/10 text-cyan-500';
                                        } elseif ($scoreValue >= 80) {
                                            $label = 'Sangat Baik';
                                            $labelClass = 'bg-emerald-500/10 text-emerald-500';
                                        } elseif ($scoreValue >= 70) {
                                            $label = 'Baik';
                                            $labelClass = 'bg-blue-500/10 text-blue-500';
                                        } elseif ($scoreValue >= 60) {
                                            $label = 'Cukup';
                                            $labelClass = 'bg-yellow-500/10 text-yellow-500';
                                        } else {
                                            $label = 'Berprogres';
                                            $labelClass = 'bg-slate-500/10 text-slate-500';
                                        }
                                        $progress = max(0, min(100, $scoreValue));
                                    } else {
                                        $label = $score ?: 'Berprogres';
                                        $labelClass = 'bg-slate-500/10 text-slate-500';
                                        $progress = 0;
                                    }
                                @endphp
                                <tr>
                                    <td class="py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-500/10 text-[10px] font-bold text-indigo-500">
                                                {{ $abbr }}
                                            </div>
                                            <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $subject }}</span>
                                        </div>
                                    </td>
                                    <td class="py-5 text-xs text-slate-500 max-w-[200px] truncate">
                                        {{ $outcome->note ?: 'Belum ada catatan.' }}
                                    </td>
                                    <td class="py-5">
                                        <div class="h-1.5 w-32 rounded-full bg-slate-100 dark:bg-slate-800">
                                            <div class="h-full rounded-full bg-indigo-500" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </td>
                                    <td class="py-5 text-right">
                                        <span class="inline-flex px-2 py-1 text-[9px] font-bold uppercase rounded {{ $labelClass }}">
                                            {{ $label }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-sm text-slate-500 dark:text-slate-400">
                                        Belum ada capaian siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="col-span-12 lg:col-span-4 rounded-3xl border border-slate-200/60 bg-white/70 p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Catatan Guru</h3>
                        <p class="text-xs text-slate-500">Masukan dan umpan balik</p>
                    </div>
                    <button
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-admin-primary/10 text-admin-primary transition hover:bg-admin-primary hover:text-white"
                        data-modal-target="note-modal"
                        type="button">
                        <span class="material-symbols-outlined text-lg">add</span>
                    </button>
                </div>
                <div class="max-h-[380px] space-y-6 overflow-y-auto pr-2 custom-scrollbar">
                    @forelse ($notes as $note)
                        <div class="relative border-l border-slate-200 pl-6 dark:border-slate-800">
                            <div
                                class="absolute -left-[5px] top-0 h-2.5 w-2.5 rounded-full bg-admin-primary ring-4 ring-white dark:ring-slate-900/60">
                            </div>
                            <div class="mb-1 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-900 dark:text-white">
                                    {{ $note->teacher->name ?? 'Guru' }}
                                </span>
                                <span class="text-[10px] text-slate-400">
                                    {{ optional($note->created_at)->format('d M Y') ?? '-' }}
                                </span>
                            </div>
                            <p class="text-xs italic text-slate-500">
                                "{{ $note->note }}"
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada catatan guru.</p>
                    @endforelse
                </div>
                <button
                    class="mt-6 w-full rounded-xl border border-slate-100 bg-slate-50 py-2.5 text-[10px] font-bold uppercase text-slate-500 transition hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-400 dark:hover:bg-slate-800"
                    type="button">
                    Lihat Semua Catatan
                </button>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center px-4" data-modal="attendance-modal">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/70"></div>
        <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Update Absensi</h3>
                <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                    data-modal-close type="button">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            @if (old('_modal') === 'attendance-modal' && $errors->any())
                <div class="mb-4 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-xs text-rose-200">
                    Mohon periksa kembali input absensi.
                </div>
            @endif
            <form method="POST" action="{{ route($attendanceStoreRoute, $student) }}">
                @csrf
                <input type="hidden" name="_modal" value="attendance-modal">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Hadir</label>
                        <input type="number" min="0" name="present" value="{{ old('present', $attendance['present']) }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Sakit</label>
                        <input type="number" min="0" name="sick" value="{{ old('sick', $attendance['sick']) }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Izin</label>
                        <input type="number" min="0" name="permit" value="{{ old('permit', $attendance['permit']) }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Alpha</label>
                        <input type="number" min="0" name="absent" value="{{ old('absent', $attendance['absent']) }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" data-modal-close
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-admin-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-admin-primary-hover">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center px-4" data-modal="goal-modal">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/70"></div>
        <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Tujuan Pembelajaran</h3>
                <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                    data-modal-close type="button">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            @if (old('_modal') === 'goal-modal' && $errors->any())
                <div class="mb-4 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-xs text-rose-200">
                    Mohon periksa kembali input tujuan pembelajaran.
                </div>
            @endif
            <form method="POST" action="{{ route($goalStoreRoute, $student) }}">
                @csrf
                <input type="hidden" name="_modal" value="goal-modal">
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Nama Tujuan</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" data-modal-close
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-admin-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-admin-primary-hover">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center px-4" data-modal="outcome-modal">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/70"></div>
        <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Capaian Siswa</h3>
                <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                    data-modal-close type="button">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            @if (old('_modal') === 'outcome-modal' && $errors->any())
                <div class="mb-4 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-xs text-rose-200">
                    Mohon periksa kembali input capaian siswa.
                </div>
            @endif
            <form method="POST" action="{{ route($outcomeStoreRoute, $student) }}">
                @csrf
                <input type="hidden" name="_modal" value="outcome-modal">
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Tujuan Pembelajaran</label>
                        <select name="learning_goal_id"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
                            {{ $availableGoals->isEmpty() ? 'disabled' : '' }}>
                            <option value="">Pilih tujuan pembelajaran</option>
                            @foreach ($availableGoals as $goal)
                                <option value="{{ $goal->id }}" {{ old('learning_goal_id') == $goal->id ? 'selected' : '' }}>
                                    {{ $goal->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($availableGoals->isEmpty())
                            <p class="mt-2 text-xs text-slate-500">Belum ada tujuan pembelajaran untuk kelas ini.</p>
                        @endif
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Skor</label>
                        <input type="text" name="score" value="{{ old('score') }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-500">Catatan</label>
                        <textarea name="note" rows="3"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">{{ old('note') }}</textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" data-modal-close
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-admin-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-admin-primary-hover"
                        {{ $availableGoals->isEmpty() ? 'disabled' : '' }}>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center px-4" data-modal="note-modal">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/70"></div>
        <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Catatan Guru</h3>
                <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                    data-modal-close type="button">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            @if (old('_modal') === 'note-modal' && $errors->any())
                <div class="mb-4 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-xs text-rose-200">
                    Mohon periksa kembali input catatan guru.
                </div>
            @endif
            <form method="POST" action="{{ route($noteStoreRoute, $student) }}">
                @csrf
                <input type="hidden" name="_modal" value="note-modal">
                <div>
                    <label class="text-xs font-semibold text-slate-500">Catatan</label>
                    <textarea name="note" rows="4"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-admin-primary focus:ring-admin-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">{{ old('note') }}</textarea>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" data-modal-close
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-admin-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-admin-primary-hover">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (() => {
            const openModal = (name) => {
                if (!name) return;
                const modal = document.querySelector(`[data-modal=\"${name}\"]`);
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            const closeModal = (modal) => {
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };

            document.querySelectorAll('[data-modal-target]').forEach((button) => {
                button.addEventListener('click', () => openModal(button.dataset.modalTarget));
            });

            document.querySelectorAll('[data-modal-close]').forEach((button) => {
                button.addEventListener('click', () => closeModal(button.closest('[data-modal]')));
            });

            document.querySelectorAll('[data-modal]').forEach((modal) => {
                modal.addEventListener('click', (event) => {
                    if (event.target === modal || event.target.classList.contains('modal-backdrop')) {
                        closeModal(modal);
                    }
                });
            });

            const openOnLoad = @json(old('_modal'));
            if (openOnLoad) {
                openModal(openOnLoad);
            }
        })();
    </script>
</x-admin-layout>


