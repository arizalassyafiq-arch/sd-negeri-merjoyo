<x-main-layout>
    {{-- Decorative Background Elements (Optional for aesthetics) --}}
    <div
        class="absolute top-0 left-0 w-full h-96 bg-linear-to-b from-emerald-50/50 to-transparent -z-10 dark:from-emerald-900/20">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mt-23">
        @php
            // Konfigurasi Warna & Icon untuk Goal Cards
            $goalIconSet = ['functions', 'translate', 'science', 'history_edu'];
            $goalColorSet = [
                ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-600 dark:text-purple-400'],
                ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-600 dark:text-blue-400'],
                ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-600 dark:text-amber-400'],
            ];
            $statusTextClass = [
                'COMPLETED' => 'text-emerald-600 dark:text-emerald-400',
                'ON TRACK' => 'text-purple-600 dark:text-purple-400',
                'IN REVIEW' => 'text-blue-600 dark:text-blue-400',
                'STARTED' => 'text-amber-600 dark:text-amber-400',
            ];
            $statusBarClass = [
                'COMPLETED' => 'bg-emerald-500',
                'ON TRACK' => 'bg-purple-500',
                'IN REVIEW' => 'bg-blue-500',
                'STARTED' => 'bg-amber-500',
            ];
        @endphp

        {{-- Header Section --}}
        <div class="flex flex-col gap-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                {{-- Breadcrumb & Title --}}
                <div class="space-y-1">
                    <nav
                        class="flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                        <a href="{{ route('wali.academic.search') }}" class="hover:text-emerald-600 transition-colors">
                            Pencarian
                        </a>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span>Rapor Digital</span>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        {{ $student->name }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-slate-400 mt-2">
                        <span
                            class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200 dark:border-emerald-800">
                            Kelas {{ $student->class_name }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">badge</span>
                            NISN: {{ $student->nisn }}
                        </span>
                        <span class="hidden md:inline">&bull;</span>
                        <span>NIK: {{ $student->nik }}</span>
                    </div>
                </div>

                {{-- Action Button --}}
                <a href="{{ route('wali.academic.search') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-bold text-slate-700 shadow-sm hover:bg-slate-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-200 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Cari Siswa Lain
                </a>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="flex flex-col gap-8">

            {{-- Row 1: Attendance & Learning Goals --}}
            <div class="grid grid-cols-12 gap-6 lg:gap-8">

                {{-- Left: Attendance Card --}}
                <div class="col-span-12 lg:col-span-4 xl:col-span-3">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-200/40 dark:shadow-none p-6 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-500">calendar_month</span>
                                Kehadiran
                            </h3>
                            <span
                                class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-900/20 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                {{ $attendance['rate'] }}%
                            </span>
                        </div>

                        <div class="space-y-4 flex-1">
                            {{-- Hadir --}}
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Hadir</span>
                                </div>
                                <span
                                    class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $attendance['present'] }}</span>
                            </div>

                            {{-- Sakit --}}
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Sakit</span>
                                </div>
                                <span class="text-xl font-bold text-orange-500">{{ $attendance['sick'] }}</span>
                            </div>

                            {{-- Izin --}}
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Izin</span>
                                </div>
                                <span class="text-xl font-bold text-blue-500">{{ $attendance['permit'] }}</span>
                            </div>

                            {{-- Alpha --}}
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Alpha</span>
                                </div>
                                <span class="text-xl font-bold text-rose-500">{{ $attendance['absent'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Learning Goals --}}
                <div class="col-span-12 lg:col-span-8 xl:col-span-9">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-200/40 dark:shadow-none p-6 md:p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Tujuan Pembelajaran</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Target capaian akademik semester ini
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse ($goalCards as $index => $goal)
                                @php
                                    $palette = $goalColorSet[$index % count($goalColorSet)];
                                    $icon = $goalIconSet[$index % count($goalIconSet)];
                                    $statusClass = $statusTextClass[$goal['status']] ?? 'text-slate-400';
                                    $barClass = $statusBarClass[$goal['status']] ?? 'bg-slate-500';
                                    $description = $goal['description'] ?: 'Target capaian belum diisi.';
                                @endphp
                                <div
                                    class="group flex items-start gap-4 rounded-2xl border border-slate-100 bg-slate-50/50 p-5 transition-all duration-300 hover:border-emerald-200 hover:bg-white hover:shadow-md dark:border-slate-700 dark:bg-slate-700/20 dark:hover:border-slate-600 dark:hover:bg-slate-700/40">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $palette['bg'] }} {{ $palette['text'] }} shrink-0 transition-transform group-hover:scale-110">
                                        <span class="material-symbols-outlined text-[24px]">{{ $icon }}</span>
                                    </div>
                                    <div class="min-w-0 flex-1 space-y-2">
                                        <div class="flex items-start justify-between gap-2">
                                            <h4
                                                class="text-sm font-bold text-slate-800 dark:text-slate-100 line-clamp-2 leading-tight">
                                                {{ $goal['title'] }}
                                            </h4>
                                            <span
                                                class="text-[10px] font-extrabold uppercase {{ $statusClass }} shrink-0 bg-white dark:bg-slate-800 px-2 py-0.5 rounded-md border border-slate-100 dark:border-slate-600">
                                                {{ str_replace('_', ' ', $goal['status']) }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                                            {{ $description }}
                                        </p>
                                        <div class="pt-2">
                                            <div
                                                class="h-2 w-full rounded-full bg-slate-200 dark:bg-slate-600 overflow-hidden">
                                                <div class="h-full rounded-full {{ $barClass }} transition-all duration-1000 ease-out"
                                                    style="width: {{ $goal['progress'] }}%"></div>
                                            </div>
                                            <div class="mt-1 text-[10px] font-semibold text-right text-slate-400">
                                                {{ number_format($goal['progress'], 0) }}% Tercapai
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-full flex flex-col items-center justify-center py-10 text-center rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700">
                                    <div
                                        class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                                        <span class="material-symbols-outlined text-slate-400">playlist_remove</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum ada tujuan
                                        pembelajaran.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 2: Outcomes & Notes --}}
            <div class="grid grid-cols-12 gap-6 lg:gap-8">

                {{-- Left: Outcomes Table --}}
                <div class="col-span-12 lg:col-span-8">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden h-full">
                        <div class="p-6 md:p-8 border-b border-slate-100 dark:border-slate-700">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Detail Nilai Capaian</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Rincian hasil evaluasi per mata
                                pelajaran</p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50/50 dark:bg-slate-700/20">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                                            Mata Pelajaran</th>
                                        <th
                                            class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                                            Catatan</th>
                                        <th
                                            class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 w-32">
                                            Skor</th>
                                        <th
                                            class="px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 text-right">
                                            Predikat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    @forelse ($outcomes as $outcome)
                                        @php
                                            $subject = $outcome->goal->title ?? '-';
                                            $abbr =
                                                strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $subject), 0, 3)) ?:
                                                'MAP';
                                            $score = $outcome->score;
                                            $scoreValue = is_numeric($score) ? (int) $score : null;

                                            // Logic Predikat
                                            if ($scoreValue !== null) {
                                                if ($scoreValue >= 90) {
                                                    $label = 'Istimewa';
                                                    $labelClass =
                                                        'bg-cyan-50 text-cyan-600 border-cyan-100 dark:bg-cyan-900/20 dark:text-cyan-400 dark:border-cyan-800';
                                                } elseif ($scoreValue >= 80) {
                                                    $label = 'Sangat Baik';
                                                    $labelClass =
                                                        'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800';
                                                } elseif ($scoreValue >= 70) {
                                                    $label = 'Baik';
                                                    $labelClass =
                                                        'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800';
                                                } elseif ($scoreValue >= 60) {
                                                    $label = 'Cukup';
                                                    $labelClass =
                                                        'bg-yellow-50 text-yellow-600 border-yellow-100 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800';
                                                } else {
                                                    $label = 'Perlu Bimbingan';
                                                    $labelClass =
                                                        'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-900/20 dark:text-rose-400 dark:border-rose-800';
                                                }
                                                $progress = max(0, min(100, $scoreValue));
                                            } else {
                                                $label = $score ?: 'Proses';
                                                $labelClass =
                                                    'bg-slate-50 text-slate-500 border-slate-100 dark:bg-slate-800 dark:text-slate-400';
                                                $progress = 0;
                                            }
                                        @endphp
                                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-[10px] font-bold text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800">
                                                        {{ $abbr }}
                                                    </div>
                                                    <span
                                                        class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-1">{{ $subject }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p
                                                    class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 max-w-50">
                                                    {{ $outcome->note ?: '-' }}
                                                </p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <div
                                                        class="h-1.5 w-full rounded-full bg-slate-100 dark:bg-slate-700">
                                                        <div class="h-full rounded-full bg-indigo-500"
                                                            style="width: {{ $progress }}%"></div>
                                                    </div>
                                                    <span
                                                        class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $scoreValue ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span
                                                    class="inline-flex px-2.5 py-1 text-[10px] font-bold uppercase rounded-lg border {{ $labelClass }}">
                                                    {{ $label }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <span
                                                        class="material-symbols-outlined text-4xl text-slate-200 dark:text-slate-700 mb-2">assignment_late</span>
                                                    <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada
                                                        data nilai yang diinput.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Right: Teacher Notes --}}
                {{-- Right: Teacher Notes & Discussion --}}
                <div class="col-span-12 lg:col-span-4">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-200/40 dark:shadow-none p-6 h-full flex flex-col">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg bg-amber-50 dark:bg-amber-900/20 text-amber-500">
                                    <span class="material-symbols-outlined">forum</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Diskusi & Catatan</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Komunikasi dengan Guru</p>
                                </div>
                            </div>
                        </div>

                        {{-- Container Scrollable --}}
                        <div class="flex-1 overflow-y-auto custom-scrollbar pr-2 space-y-6 max-h-[600px]">
                            @forelse ($notes as $note)
                                {{-- Item Diskusi (Satu Topik) --}}
                                <div class="flex flex-col gap-3" x-data="{ openReply: false }">

                                    {{-- 1. Catatan Utama Guru --}}
                                    <div class="relative pl-4 border-l-2 border-amber-200 dark:border-amber-700">
                                        <div
                                            class="bg-amber-50 dark:bg-amber-900/10 rounded-r-xl rounded-bl-xl p-4 border border-amber-100 dark:border-amber-800/30">
                                            <div class="flex items-center justify-between mb-2">
                                                <span
                                                    class="text-xs font-bold text-amber-700 dark:text-amber-400 flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[14px]">school</span>
                                                    {{ $note->teacher->name ?? 'Guru Kelas' }}
                                                </span>
                                                <span class="text-[10px] text-slate-400">
                                                    {{ optional($note->created_at)->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-700 dark:text-slate-300">
                                                "{{ $note->note }}"
                                            </p>
                                        </div>
                                    </div>

                                    {{-- 2. List Balasan (Looping Chat) --}}
                                    @foreach ($note->replies as $reply)
                                        @php
                                            // Cek apakah balasan ini dari user yang sedang login (Wali) atau Guru
                                            $isMe = $reply->user_id === auth()->id();
                                        @endphp
                                        <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                            <div
                                                class="max-w-[85%] {{ $isMe ? 'bg-emerald-500 text-white rounded-l-xl rounded-tr-xl' : 'bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-r-xl rounded-tl-xl' }} p-3 shadow-sm text-sm">
                                                <p>{{ $reply->reply_content }}</p>
                                                <div class="mt-1 text-[9px] opacity-70 text-right">
                                                    {{ $reply->created_at->format('H:i') }}
                                                    @if (!$isMe)
                                                        • {{ $reply->user->name }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- 3. Tombol & Form Balas (Menggunakan AlpineJS untuk toggle) --}}
                                    <div class="ml-4 mt-1">
                                        {{-- Tombol Buka Form --}}
                                        <button @click="openReply = !openReply" x-show="!openReply"
                                            class="text-xs font-semibold text-slate-400 hover:text-emerald-500 flex items-center gap-1 transition-colors">
                                            <span class="material-symbols-outlined text-[14px]">reply</span>
                                            Balas Pesan
                                        </button>

                                        {{-- Form Input --}}
                                        <form x-show="openReply"
                                            action="{{ route('wali.academic.reply.store', $note->id) }}"
                                            method="POST" class="flex items-end gap-2 mt-2 animate-fade-in-down"
                                            x-transition>
                                            @csrf
                                            <div class="flex-1 relative">
                                                <textarea name="reply_content" rows="1" required
                                                    class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-slate-900 dark:border-slate-700 dark:text-white px-3 py-2 resize-none custom-scrollbar"
                                                    placeholder="Tulis balasan..."></textarea>
                                            </div>
                                            <button type="submit"
                                                class="p-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl shadow-lg shadow-emerald-500/30 transition-all hover:scale-105">
                                                <span class="material-symbols-outlined text-[18px]">send</span>
                                            </button>
                                            <button type="button" @click="openReply = false"
                                                class="p-2 text-slate-400 hover:text-rose-500 transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">close</span>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Divider antar topik --}}
                                    <div class="border-b border-slate-100 dark:border-slate-700/50 pt-2"></div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center h-40 text-center opacity-60">
                                    <span
                                        class="material-symbols-outlined text-4xl text-slate-300 mb-2">chat_bubble_outline</span>
                                    <p class="text-sm text-slate-500">Belum ada catatan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-main-layout>
