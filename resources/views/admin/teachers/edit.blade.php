<x-admin-layout>
    <x-slot:title>Edit Data Guru</x-slot>

    {{-- Main Container --}}
    <div class="  px-4 md:px-8 py-12 relative z-10">

        {{-- Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white mb-2">Edit Data Guru</h1>
                <p class="text-slate-500 text-sm md:text-md dark:text-slate-400">
                    Perbarui informasi profil untuk: <span
                        class="font-bold text-slate-700 dark:text-slate-200">{{ $teacher->user->name }}</span>
                </p>
            </div>

            <div class="flex items-center gap-3 justify-end">
                <a href="{{ route('admin.teachers.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm hover:shadow-md">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Card Container --}}
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-purple-100 dark:border-purple-900/30 overflow-hidden relative">

            {{-- Gradient Line Top --}}
            <div class="h-1 w-full bg-linear-to-r from-purple-500 via-indigo-500 to-blue-500"></div>

            <div class="p-8 md:p-10">

                <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    {{-- Section 1: Data Akun --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold text-sm border border-slate-200 dark:border-slate-700">
                                1
                            </div>
                            <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                Data Akun
                            </h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- Input Nama --}}
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Nama Lengkap
                                </label>
                                <div class="relative group">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">badge</span>
                                    </span>
                                    <input type="text" name="name" value="{{ old('name', $teacher->user->name) }}"
                                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all shadow-sm group-hover:shadow-md"
                                        placeholder="Contoh: Budi Santoso, S.Pd" required>
                                </div>
                                @error('name')
                                    <p class="text-xs text-rose-500 font-semibold pl-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input Email --}}
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Alamat Email (Login)
                                </label>
                                <div class="relative group">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">alternate_email</span>
                                    </span>
                                    <input type="email" name="email"
                                        value="{{ old('email', $teacher->user->email) }}"
                                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all shadow-sm group-hover:shadow-md"
                                        placeholder="nama@sekolah.sch.id" required>
                                </div>
                                @error('email')
                                    <p class="text-xs text-rose-500 font-semibold pl-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                    <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                    {{-- Section 2: Profil Pengajar --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold text-sm border border-slate-200 dark:border-slate-700">
                                2
                            </div>
                            <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                Profil Pengajar
                            </h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- Input Mata Pelajaran --}}
                            <div class="md:col-span-2 space-y-3">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Mata Pelajaran Utama
                                </label>
                                <div class="relative group">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">menu_book</span>
                                    </span>

                                    <select name="subject"
                                        class="w-full pl-12 pr-10 py-3.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all shadow-sm appearance-none cursor-pointer group-hover:shadow-md">
                                        <option value="" disabled>Pilih Mata Pelajaran...</option>
                                        <option value="Guru Kelas"
                                            {{ old('subject', $teacher->subject) == 'Guru Kelas' ? 'selected' : '' }}>
                                            Guru Kelas (Tematik)</option>
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
                                            {{ old('subject', $teacher->subject) == 'Seni Budaya' ? 'selected' : '' }}>
                                            Seni Budaya</option>
                                    </select>

                                    {{-- Custom Dropdown Arrow --}}
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none group-hover:text-purple-500 transition-colors">
                                        <span class="material-symbols-outlined">expand_more</span>
                                    </span>
                                </div>
                                @error('subject')
                                    <p class="text-xs text-rose-500 font-semibold pl-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                    <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-6">
                        <a href="{{ route('admin.teachers.index') }}"
                            class="px-6 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700">
                            Batalkan
                        </a>

                        <button type="submit"
                            class="relative overflow-hidden px-8 py-3.5 bg-linear-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:-translate-y-0.5 transition-all duration-200 group inline-flex items-center justify-center">

                            <span class="relative z-10 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">save</span>
                                <span class="whitespace-nowrap">Simpan Perubahan</span>
                            </span>

                            {{-- Hover Effect Overlay --}}
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
