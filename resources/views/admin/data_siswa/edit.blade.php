<x-admin-layout>
    <x-slot:title>Edit Siswa</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Data Siswa</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Update informasi {{ $student->name }}.</p>
            </div>
            <a href="{{ route('admin.students.index') }}"
                class="px-4 py-2 bg-slate-800 text-slate-300 text-sm font-semibold rounded-xl hover:bg-slate-700 transition">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.students.update', $student->id) }}" method="POST"
            class="bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">
            @csrf
            @method('PUT')

            <div class="mb-8">
                <h3 class="text-admin-primary font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">badge</span> Identitas Siswa
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-admin-primary focus:ring-1 focus:ring-admin-primary outline-none">
                        @error('name')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Jenis Kelamin</label>
                        <select name="gender"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                            <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('gender')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $student->nis) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                        @error('nis')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $student->nik) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                        @error('nik')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-admin-primary font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">school</span> Akademik
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Kelas</label>
                        <select name="class_name"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                            @foreach (['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'] as $kls)
                                <option value="{{ $kls }}"
                                    {{ old('class_name', $student->class_name) == $kls ? 'selected' : '' }}>
                                    {{ $kls }}</option>
                            @endforeach
                        </select>
                        @error('class_name')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Status Siswa</label>
                        <select name="status"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                            <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="lulus" {{ old('status', $student->status) == 'lulus' ? 'selected' : '' }}>
                                Lulus</option>
                            <option value="pindah" {{ old('status', $student->status) == 'pindah' ? 'selected' : '' }}>
                                Pindah</option>
                            <option value="drop_out"
                                {{ old('status', $student->status) == 'drop_out' ? 'selected' : '' }}>Drop Out</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-admin-primary font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">contact_page</span> Detail & Alamat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Tempat Lahir</label>
                        <input type="text" name="birth_place"
                            value="{{ old('birth_place', $student->birth_place) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">
                        @error('birth_place')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Tanggal Lahir</label>
                        <input type="date" name="birth_date"
                            value="{{ old('birth_date', $student->birth_date ? $student->birth_date->format('Y-m-d') : '') }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none scheme:dark">
                        @error('birth_date')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Alamat Lengkap</label>
                    <textarea name="address" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none">{{ old('address', $student->address) }}</textarea>
                    @error('address')
                        <span class="text-rose-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-admin-primary font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">family_restroom</span> Data Orang Tua
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Nama Ayah</label>
                        <input type="text" name="father_name"
                            value="{{ old('father_name', $student->father_name) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none"
                            placeholder="Nama Ayah Kandung">
                        @error('father_name')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Nama Ibu</label>
                        <input type="text" name="mother_name"
                            value="{{ old('mother_name', $student->mother_name) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 outline-none"
                            placeholder="Nama Ibu Kandung">
                        @error('mother_name')
                            <span class="text-rose-400 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-800">
                <button type="submit"
                    class="bg-admin-primary hover:bg-admin-primary-hover text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    Update Data Siswa
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
