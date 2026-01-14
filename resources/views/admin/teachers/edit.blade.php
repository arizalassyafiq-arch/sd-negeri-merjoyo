<x-admin-layout>
    <x-slot:title>Edit Data Guru</x-slot>

    <div class="max-w-3xl mx-auto flex flex-col gap-6">

        <div class="flex items-center gap-4">
            <a href="{{ route('admin.teachers.index') }}"
                class="p-2.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-slate-800 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm">
                <span class="material-symbols-outlined block text-[20px]">arrow_back</span>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Edit Guru</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Perbarui informasi profil atau akun login.</p>
            </div>
        </div>

        <div
            class="bg-white/70 dark:bg-slate-900/60 rounded-3xl border border-slate-200/60 dark:border-slate-800 shadow-xl shadow-slate-900/5 backdrop-blur-sm overflow-hidden">

            <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- Section 1 --}}
                    <div>
                        <h3
                            class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span
                                class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 text-xs">1</span>
                            Data Akun
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-500 uppercase">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $teacher->user->name) }}"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                    required>
                                @error('name')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-500 uppercase">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $teacher->user->email) }}"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                    required>
                                @error('email')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 dark:border-slate-800"></div>

                    {{-- Section 2 --}}
                    <div>
                        <h3
                            class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span
                                class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 text-xs">2</span>
                            Profil Pengajar
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-500 uppercase">NIP</label>
                                <input type="text" name="nip" value="{{ old('nip', $teacher->nip) }}"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                    required>
                                @error('nip')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-500 uppercase">Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400">
                                @error('phone')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <div class="md:col-span-2 space-y-1">
                                <label class="text-xs font-bold text-slate-500 uppercase">Mata Pelajaran Utama</label>
                                <select name="subject"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                                    <option value="Guru Kelas"
                                        {{ old('subject', $teacher->subject) == 'Guru Kelas' ? 'selected' : '' }}>Guru
                                        Kelas (Tematik)</option>
                                    <option value="Pendidikan Agama Islam"
                                        {{ old('subject', $teacher->subject) == 'Pendidikan Agama Islam' ? 'selected' : '' }}>
                                        Pendidikan Agama Islam</option>
                                    <option value="PJOK"
                                        {{ old('subject', $teacher->subject) == 'PJOK' ? 'selected' : '' }}>PJOK
                                        (Olahraga)</option>
                                    <option value="Matematika"
                                        {{ old('subject', $teacher->subject) == 'Matematika' ? 'selected' : '' }}>
                                        Matematika</option>
                                    <option value="Bahasa Inggris"
                                        {{ old('subject', $teacher->subject) == 'Bahasa Inggris' ? 'selected' : '' }}>
                                        Bahasa Inggris</option>
                                    <option value="Seni Budaya"
                                        {{ old('subject', $teacher->subject) == 'Seni Budaya' ? 'selected' : '' }}>Seni
                                        Budaya</option>
                                </select>
                                @error('subject')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                    <a href="#" onclick="history.back()"
                        class="px-6 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">update</span>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-admin-layout>
