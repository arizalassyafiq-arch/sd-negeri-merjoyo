<x-admin-layout>
    <x-slot:title>Tambah Siswa</x-slot>

    {{-- Main Container --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Page --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white tracking-tight">Registrasi Siswa</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Tambahkan data siswa baru ke dalam database sekolah.
                </p>
            </div>
            <a href="{{ route('admin.students.index') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm hover:shadow-md">
                <span class="material-symbols-outlined text-[20px] mr-2">arrow_back</span>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-8">
            @csrf

            {{-- SECTION 1: IDENTITAS UTAMA --}}
            <div
                class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 lg:p-10 shadow-sm dark:shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    {{-- Kolom Kiri --}}
                    <div class="lg:col-span-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-500">
                                <span class="material-symbols-outlined">badge</span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Identitas Siswa</h2>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            Pastikan data <strong>NIK</strong> dan <strong>NISN</strong> diinput dengan benar untuk
                            keperluan validasi data nasional (Dapodik).
                        </p>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="lg:col-span-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Lengkap --}}
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm"
                                    placeholder="Masukkan nama lengkap siswa">
                                @error('name')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- NISN --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">NISN</label>
                                <input type="text" name="nisn" value="{{ old('nisn') }}" minlength="10"
                                    maxlength="10" inputmode="numeric" pattern="[0-9]{10}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm"
                                    placeholder="Nomor Induk Siswa Nasional">
                                @error('nisn')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- NIK --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">NIK</label>
                                <input type="text" name="nik" value="{{ old('nik') }}" minlength="16"
                                    maxlength="16" inputmode="numeric" pattern="[0-9]{16}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm"
                                    placeholder="16 Digit Nomor Induk Kependudukan">
                                @error('nik')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Jenis
                                    Kelamin</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="gender" value="L" class="peer sr-only"
                                            {{ old('gender') == 'L' ? 'checked' : '' }}>
                                        <div
                                            class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl p-4 flex items-center justify-center gap-2 text-slate-500 dark:text-slate-400 peer-checked:bg-blue-50 peer-checked:border-blue-200 peer-checked:text-blue-600 dark:peer-checked:bg-blue-500/10 dark:peer-checked:border-blue-500 dark:peer-checked:text-blue-500 transition-all hover:bg-slate-100 dark:hover:bg-slate-900 shadow-sm">
                                            <span class="material-symbols-outlined">male</span> Laki-laki
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="gender" value="P" class="peer sr-only"
                                            {{ old('gender') == 'P' ? 'checked' : '' }}>
                                        <div
                                            class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl p-4 flex items-center justify-center gap-2 text-slate-500 dark:text-slate-400 peer-checked:bg-pink-50 peer-checked:border-pink-200 peer-checked:text-pink-600 dark:peer-checked:bg-pink-500/10 dark:peer-checked:border-pink-500 dark:peer-checked:text-pink-500 transition-all hover:bg-slate-100 dark:hover:bg-slate-900 shadow-sm">
                                            <span class="material-symbols-outlined">female</span> Perempuan
                                        </div>
                                    </label>
                                </div>
                                @error('gender')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: DATA AKADEMIK --}}
            <div
                class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 lg:p-10 shadow-sm dark:shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-500">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Akademik</h2>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            Tentukan penempatan kelas awal siswa dan status keaktifannya saat ini.
                        </p>
                    </div>

                    <div class="lg:col-span-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kelas --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Rombongan
                                    Belajar (Kelas)</label>
                                <div class="relative">
                                    <select name="classroom_id"
                                        class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-all appearance-none shadow-sm cursor-pointer">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}"
                                                {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                                {{ $classroom->name }} -
                                                {{ $classroom->teacher ? $classroom->teacher->user->name : 'Tanpa Wali' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 pointer-events-none">expand_more</span>
                                </div>
                                @error('classroom_id')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Status
                                    Kesiswaan</label>
                                <div class="relative">
                                    <select name="status"
                                        class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-all appearance-none shadow-sm cursor-pointer">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="lulus">Lulus</option>
                                        <option value="pindah">Pindah Sekolah</option>
                                        <option value="drop_out">Drop Out (DO)</option>
                                    </select>
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 3: DOMISILI --}}
            <div
                class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 lg:p-10 shadow-sm dark:shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-500">
                                <span class="material-symbols-outlined">contact_page</span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Domisili & Lahir</h2>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            Alamat sesuai dengan Kartu Keluarga (KK) dan data kelahiran sesuai Akta Kelahiran.
                        </p>
                    </div>

                    <div class="lg:col-span-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Tempat Lahir --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tempat
                                    Lahir</label>
                                <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm">
                                @error('birth_place')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tanggal
                                    Lahir</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition-all scheme-light dark:scheme-dark shadow-sm">
                                @error('birth_date')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Alamat
                                    Lengkap</label>
                                <textarea name="address" rows="3"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 resize-none shadow-sm"
                                    placeholder="Jalan, RT/RW, Kelurahan, Kecamatan">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 4: DATA ORANG TUA --}}
            <div
                class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 lg:p-10 shadow-sm dark:shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-500">
                                <span class="material-symbols-outlined">family_restroom</span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Data Orang Tua</h2>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            Data ini digunakan untuk verifikasi saat pendaftaran akun Wali Murid di aplikasi.
                        </p>
                    </div>

                    <div class="lg:col-span-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama
                                    Ayah Kandung</label>
                                <input type="text" name="father_name" value="{{ old('father_name') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm">
                                @error('father_name')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama
                                    Ibu Kandung</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-xl px-5 py-3.5 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 shadow-sm">
                                @error('mother_name')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex items-center justify-end pt-6">
                <button type="submit"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-linear-to-r from-blue-600 to-indigo-600 rounded-2xl focus:outline-none hover:from-blue-700 hover:to-indigo-700 hover:shadow-lg hover:shadow-blue-500/30 hover:-translate-y-1">
                    <span class="mr-2">Simpan Data Siswa</span>
                    <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </div>

        </form>
    </div>
</x-admin-layout>
