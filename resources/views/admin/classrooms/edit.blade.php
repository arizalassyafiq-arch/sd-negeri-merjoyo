<x-admin-layout>
    <x-slot:title>Edit Kelas</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Data Kelas</h2>
            <a href="{{ route('admin.classrooms.index') }}"
                class="text-sm font-semibold text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.classrooms.update', $classroom) }}" method="POST"
            class="bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">
            @csrf
            @method('PUT')

            {{-- Nama Kelas --}}
            <div class="mb-6">
                <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Nama Kelas</label>
                <input type="text" name="name" value="{{ old('name', $classroom->name) }}"
                    class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all"
                    placeholder="Contoh: Kelas 1">
                @error('name')
                    <span class="text-xs text-rose-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Pilih Wali Kelas --}}
            <div class="mb-6">
                <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Wali Kelas (Guru)</label>
                <select name="teacher_id"
                    class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            {{ old('teacher_id', $classroom->teacher_id) == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->user->name }} ({{ $teacher->subject ?? 'Guru Mapel' }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-slate-500 mt-2">*Mengubah wali kelas akan memperbarui data seluruh siswa di kelas
                    ini.</p>
                @error('teacher_id')
                    <span class="text-xs text-rose-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-4 mt-8">
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.classrooms.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-700 text-slate-300 font-semibold hover:bg-slate-800 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
