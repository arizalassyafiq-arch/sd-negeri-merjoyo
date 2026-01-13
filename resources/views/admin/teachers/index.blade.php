<x-admin-layout>
    <x-slot:title>Manajemen Guru</x-slot>

    <div class="flex flex-col gap-6">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Data Guru</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola data pengajar dan akun akses mereka.</p>
            </div>
            <a href="{{ route('admin.teachers.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Guru Baru
            </a>
        </div>

        {{-- Alert Status --}}
        @if (session('status'))
            <div
                class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('status') }}
            </div>
        @endif

        {{-- Content Card --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/5 backdrop-blur-sm">

            {{-- Search & Filter Bar (Opsional, bisa dikembangkan) --}}
            {{-- <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex justify-end">
                <input type="text" placeholder="Cari nama guru..." class="text-sm rounded-xl border-slate-200 bg-slate-50 ...">
            </div> --}}

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/80 dark:bg-slate-800/80 border-b border-slate-200/80 dark:border-slate-700">
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Profil Guru
                            </th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">NIP /
                                Kontak</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Mata
                                Pelajaran</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($teachers as $teacher)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-sm font-bold shadow-sm ring-1 ring-slate-900/5">
                                            {{ substr($teacher->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white text-sm group-hover:text-blue-600 transition-colors">
                                                {{ $teacher->user->name }}</p>
                                            <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                                <span class="material-symbols-outlined text-[12px]">mail</span>
                                                {{ $teacher->user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-200 dark:border-slate-700">NIP</span>
                                            <span
                                                class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $teacher->nip }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-200 dark:border-slate-700">HP</span>
                                            <span class="text-xs text-slate-500">{{ $teacher->phone ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800/30">
                                        {{ $teacher->subject }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                            class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all"
                                            title="Edit Data">
                                            <span class="material-symbols-outlined text-[20px]">edit_square</span>
                                        </a>

                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini? Akun login guru tersebut juga akan dihapus permanen.');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all"
                                                title="Hapus Guru">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div
                                            class="h-16 w-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300">
                                            <span class="material-symbols-outlined text-4xl">person_off</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-slate-900 dark:text-white font-medium">Belum ada data guru
                                            </p>
                                            <p class="text-slate-500 text-sm mt-1">Silakan tambahkan guru baru untuk
                                                memulai.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            @if ($teachers->hasPages())
                <div
                    class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
