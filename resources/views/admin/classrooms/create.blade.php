<x-admin-layout>
    <x-slot:title>Tambah Kelas</x-slot>

    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold text-white mb-6">Buat Kelas & Wali Kelas</h2>

        <form action="{{ route('admin.classrooms.store') }}" method="POST"
            class="bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">
            @csrf

            {{-- Nama Kelas --}}
            <div class="mb-6">
                <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Nama Kelas</label>
                <input type="text" name="name"
                    class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3"
                    placeholder="Contoh: Kelas 1">
            </div>

            {{-- Pilih Wali Kelas --}}
            <div class="mb-6">
                <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Wali Kelas (Guru)</label>
                <select name="teacher_id"
                    class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3">
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{ $teacher->user->name }} ({{ $teacher->subject ?? 'Guru Mapel' }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-slate-500 mt-2">*Guru yang dipilih akan otomatis menjadi wali kelas untuk semua
                    siswa di kelas ini.</p>
            </div>

            <button type="submit"
                class="w-full bg-admin-primary hover:bg-admin-primary-hover text-white font-bold py-3 rounded-xl">
                Simpan Kelas
            </button>
        </form>
    </div>
</x-admin-layout>
