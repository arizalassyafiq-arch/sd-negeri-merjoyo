<x-admin-layout>
    <x-slot:title>Tambah Kelas</x-slot>

    {{-- Main Container --}}
    <div class="max-w-8xl  px-4 md:px-8 py-12 relative z-10">

        {{-- Header Section --}}
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Buat Kelas & Wali Kelas</h1>
            <p class="text-slate-500 dark:text-slate-400">Buat kelas baru dan tentukan wali kelas dengan efisien.</p>
        </div>

        {{-- Card Container --}}
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-purple-100 dark:border-purple-900/30 overflow-hidden relative">

            {{-- Gradient Line Top --}}
            <div class="h-1 w-full bg-linear-to-r from-purple-500 via-indigo-500 to-blue-500"></div>

            <div class="p-8 md:p-10">
                <form action="{{ route('admin.classrooms.store') }}" method="POST" class="space-y-10">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-12">

                        {{-- Input Nama Kelas --}}
                        <div class="space-y-4">
                            <label
                                class=" text-sm font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center text-purple-600 dark:text-purple-300">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </span>
                                Nama Kelas
                            </label>
                            <div class="relative group">
                                <select name="name"
                                    class="w-full px-4 py-4 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all shadow-sm appearance-none cursor-pointer group-hover:shadow-md">
                                    <option value="" disabled selected>-- Pilih Tingkat Kelas --</option>

                                    {{-- Loop untuk membuat opsi Kelas 1 s/d 6 --}}
                                    @foreach (range(1, 6) as $i)
                                        <option value="Kelas {{ $i }}"
                                            {{ old('name') == "Kelas $i" ? 'selected' : '' }}>
                                            Kelas {{ $i }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="mt-2 text-xs text-slate-400 pl-1">Pilih tingkat kelas untuk identifikasi.</p>

                                @error('name')
                                    <p class="mt-1 text-xs text-rose-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Input Wali Kelas --}}
                        {{-- Input Wali Kelas (Searchable Dropdown) --}}
                        <div class="space-y-4" x-data="teacherSelect({
                            data: {{ $teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name . ' (' . ($t->subject ?? '-') . ')']) }},
                            selectedId: '{{ old('teacher_id') }}'
                        })" @click.outside="open = false">

                            <label
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                    <span class="material-symbols-outlined text-lg">person_search</span>
                                </span>
                                Wali Kelas (Guru)
                            </label>

                            <div class="relative group">
                                {{-- 1. Hidden Input untuk dikirim ke Controller --}}
                                <input type="hidden" name="teacher_id" x-model="selectedId">

                                {{-- 2. Input Tampilan (Search) --}}
                                <div class="relative">
                                    <input type="text" x-model="search"
                                        @focus="open = true; placeholder = 'Cari nama guru...'"
                                        @blur="placeholder = '-- Pilih Guru --'"
                                        class="w-full px-4 py-4 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all shadow-sm cursor-text"
                                        :placeholder="selectedName ? selectedName : '-- Pilih Guru --'"
                                        placeholder="-- Pilih Guru --">

                                    {{-- Icon Panah / Clear --}}
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center">
                                        <button type="button" x-show="selectedId" @click="clearSelection()"
                                            class="text-slate-400 hover:text-rose-500 mr-2">
                                            <span class="material-symbols-outlined text-lg">close</span>
                                        </button>
                                        <span
                                            class="material-symbols-outlined text-slate-400 pointer-events-none text-lg transition-transform duration-200"
                                            :class="{ 'rotate-180': open }">expand_more</span>
                                    </div>
                                </div>

                                {{-- 3. Dropdown List Hasil Pencarian --}}
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="absolute z-50 mt-2 w-full bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 max-h-60 overflow-y-auto custom-scrollbar"
                                    style="display: none;">

                                    {{-- Jika hasil kosong --}}
                                    <div x-show="filteredOptions.length === 0"
                                        class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                                        Tidak ada guru ditemukan.
                                    </div>

                                    {{-- Loop Data Guru --}}
                                    <template x-for="item in filteredOptions" :key="item.id">
                                        <div @click="selectOption(item)"
                                            class="px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-purple-50 dark:hover:bg-purple-900/30 cursor-pointer flex items-center justify-between group transition-colors">
                                            <span x-text="item.name"></span>
                                            {{-- Centang jika terpilih --}}
                                            <span x-show="selectedId == item.id"
                                                class="material-symbols-outlined text-purple-600 text-sm font-bold">check</span>
                                        </div>
                                    </template>
                                </div>

                                <p class="mt-2 text-xs text-slate-400 pl-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">info</span>
                                    Ketik nama guru untuk mencari.
                                </p>
                                @error('teacher_id')
                                    <p class="mt-1 text-xs text-rose-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Separator Line --}}
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800"></div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.classrooms.index') }}"
                            class="px-6 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batalkan
                        </a>

                        <button type="submit"
                            class="relative overflow-hidden px-8 py-3.5 bg-linear-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:-translate-y-0.5 transition-all duration-200 group">
                            <span class="relative z-10 flex items-center gap-2">
                                Simpan Kelas
                                <span
                                    class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </span>
                            {{-- Button Hover Effect --}}
                            <div
                                class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            </div>
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Footer Text --}}
        <div class="mt-8 text-center text-xs text-slate-400 dark:text-slate-600">
            &copy; {{ date('Y') }} EduAdmin Console. All rights reserved.
        </div>
    </div>

</x-admin-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('teacherSelect', (config) => ({
            data: config.data,
            open: false,
            search: '',
            selectedId: config.selectedId,

            get selectedName() {
                const selected = this.data.find(i => i.id == this.selectedId);
                return selected ? selected.name : null;
            },

            get filteredOptions() {
                if (this.search === '') {
                    return this.data;
                }
                return this.data.filter(item => {
                    return item.name.toLowerCase().includes(this.search.toLowerCase());
                });
            },

            selectOption(item) {
                this.selectedId = item.id;
                this.search = '';
                this.open = false;
            },

            // Aksi hapus pilihan
            clearSelection() {
                this.selectedId = '';
                this.search = '';
            }
        }))
    })
</script>
