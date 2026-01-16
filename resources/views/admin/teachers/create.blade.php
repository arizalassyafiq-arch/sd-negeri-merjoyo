<x-admin-layout>
    <x-slot:title>Tambah Guru Baru</x-slot>

    {{-- Main Container --}}
    <div class="max-w-6xl mx-auto px-4 md:px-4 py-6 relative z-10">

        {{-- Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white mb-2">Registrasi Guru</h1>
                <p class="text-slate-500  text-sm md:text-md dark:text-slate-400">Akun login akan dibuat secara otomatis
                    dengan password
                    default.</p>
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

                {{-- Info Alert --}}
                <div
                    class="mb-8 rounded-xl bg-purple-50 dark:bg-purple-900/10 border border-purple-100 dark:border-purple-800/30 p-4 flex items-start gap-4">
                    <div
                        class="p-2 rounded-lg bg-purple-100 dark:bg-purple-800/40 text-purple-600 dark:text-purple-300 shrink-0">
                        <span class="material-symbols-outlined text-xl">info</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-purple-700 dark:text-purple-300 mb-1">Informasi Akun Otomatis
                        </h4>
                        <p class="text-sm text-purple-600/90 dark:text-purple-200/80 leading-relaxed italic">
                            Sistem akan membuat akun dengan <strong>Email</strong> yang diinputkan dan Password Default:
                            <code
                                class="px-2 py-0.5 rounded bg-purple-200 dark:bg-purple-800 text-purple-800 dark:text-white font-mono font-bold text-xs mx-1">guru123</code>.
                            Mohon informasikan kepada guru terkait untuk segera mengganti password setelah login pertama
                            kali.
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-10">
                    @csrf

                    {{-- Section 1: Data Akun --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold text-sm border border-slate-200 dark:border-slate-700">
                                1</div>
                            <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                Data Akun</h3>
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
                                    <input type="text" name="name" value="{{ old('name') }}"
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
                                    <input type="email" name="email" value="{{ old('email') }}"
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
                                2</div>
                            <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                Profil Pengajar</h3>
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

                                        <option value="" disabled selected>Pilih Mata Pelajaran...</option>

                                        {{-- Daftar Mata Pelajaran Lengkap (Gabungan Kelas 1-6) --}}
                                        <option value="Pendidikan Agama dan Budi Pekerti"
                                            {{ old('subject', $teacher->subject ?? '') == 'Pendidikan Agama dan Budi Pekerti' ? 'selected' : '' }}>
                                            Pendidikan Agama dan Budi Pekerti
                                        </option>

                                        <option value="Pendidikan Kewarganegaraan"
                                            {{ old('subject', $teacher->subject ?? '') == 'Pendidikan Kewarganegaraan' ? 'selected' : '' }}>
                                            Pendidikan Kewarganegaraan
                                        </option>

                                        <option value="Bahasa Indonesia"
                                            {{ old('subject', $teacher->subject ?? '') == 'Bahasa Indonesia' ? 'selected' : '' }}>
                                            Bahasa Indonesia
                                        </option>

                                        <option value="Matematika"
                                            {{ old('subject', $teacher->subject ?? '') == 'Matematika' ? 'selected' : '' }}>
                                            Matematika
                                        </option>

                                        <option value="IPAS"
                                            {{ old('subject', $teacher->subject ?? '') == 'IPAS' ? 'selected' : '' }}>
                                            IPAS (Ilmu Pengetahuan Alam dan Sosial)
                                        </option>

                                        <option value="PJOK"
                                            {{ old('subject', $teacher->subject ?? '') == 'PJOK' ? 'selected' : '' }}>
                                            PJOK (Olahraga)
                                        </option>

                                        <option value="Seni Rupa"
                                            {{ old('subject', $teacher->subject ?? '') == 'Seni Rupa' ? 'selected' : '' }}>
                                            Seni Rupa
                                        </option>

                                        <option value="Bahasa Jawa"
                                            {{ old('subject', $teacher->subject ?? '') == 'Bahasa Jawa' ? 'selected' : '' }}>
                                            Bahasa Jawa
                                        </option>

                                        <option value="Bahasa Inggris"
                                            {{ old('subject', $teacher->subject ?? '') == 'Bahasa Inggris' ? 'selected' : '' }}>
                                            Bahasa Inggris
                                        </option>
                                    </select>
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
                            class="px-6 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors bg-slate-200">
                            Batalkan
                        </a>

                        <button type="submit"
                            class="relative overflow-hidden px-4 py-3.5 bg-linear-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:-translate-y-0.5 transition-all duration-200 group items-center justify-center inline-flex">

                            <!-- FIX DI SINI -->
                            <span
                                class="relative z-10 inline-flex items-center gap-2 text-sm leading-none whitespace-nowrap">
                                <span class="material-symbols-outlined text-[20px] leading-none">
                                    save
                                </span>
                                <span class="leading-none">Simpan Data</span>
                            </span>

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
