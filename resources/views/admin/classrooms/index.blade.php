<x-admin-layout>
    <x-slot:title>Manajemen Kelas</x-slot>

    <div class="flex flex-col gap-6">

        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Daftar Kelas</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola data kelas dan wali kelas.</p>
            </div>
            <a href="{{ route('admin.classrooms.create') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-500/30">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Buat Kelas Baru
            </a>
        </div>

        {{-- Alert Success --}}
        @if (session('status'))
            <div
                class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="font-semibold">{{ session('status') }}</span>
            </div>
        @endif

        {{-- Table Section --}}
        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-900/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50/70 dark:bg-slate-800/60 border-b border-slate-200/60 dark:border-slate-800">
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Kelas
                            </th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Wali Kelas
                            </th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Jumlah
                                Siswa</th>
                            <th
                                class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/80 dark:divide-slate-800">
                        @forelse ($classrooms as $classroom)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-900 dark:text-white text-sm">
                                        {{ $classroom->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($classroom->teacher)
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-xs">
                                                {{ substr($classroom->teacher->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                    {{ $classroom->teacher->user->name }}
                                                </p>
                                                <p class="text-[10px] text-slate-500">
                                                    {{ $classroom->teacher->subject ?? 'Guru Kelas' }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                            Belum Ada Wali
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">
                                        {{ $classroom->students_count ?? 0 }} Siswa
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                                            class="p-2 rounded-lg text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors"
                                            title="Edit Kelas">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>

                                        {{-- Delete Button with Confirmation --}}
                                        <form action="{{ route('admin.classrooms.destroy', $classroom) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini? Siswa di dalamnya tidak akan terhapus namun kehilangan relasi kelas.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors"
                                                title="Hapus Kelas">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center opacity-50">
                                        <span
                                            class="material-symbols-outlined text-4xl text-slate-400 mb-2">meeting_room</span>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada data kelas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (Optional) --}}
            @if (method_exists($classrooms, 'links'))
                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                    {{ $classrooms->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
