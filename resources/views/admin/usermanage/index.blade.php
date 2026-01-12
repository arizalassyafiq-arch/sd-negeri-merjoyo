<x-admin-layout>
    <x-slot:title>Approval Wali Murid</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Persetujuan Akun Wali Murid
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Verifikasi data pendaftar sebelum memberikan akses.
                </p>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Wali
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Email
                                </th>
                                {{-- KOLOM BARU --}}
                                <th class="px-4 py-3 text-left font-semibold text-indigo-600 dark:text-indigo-400">Siswa
                                    yang Diklaim</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tanggal
                                    Daftar</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($wali as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>

                                    {{-- TAMPILKAN DATA ANAK --}}
                                    <td class="px-4 py-3">
                                        @if ($user->students->isNotEmpty())
                                            <div class="flex flex-col gap-1">
                                                @foreach ($user->students as $child)
                                                    <div
                                                        class="inline-flex items-center gap-2 bg-indigo-50 dark:bg-indigo-900/20 px-2 py-1 rounded-lg border border-indigo-100 dark:border-indigo-800 w-fit">
                                                        <span
                                                            class="material-symbols-outlined text-sm text-indigo-500">face</span>
                                                        <div>
                                                            <span
                                                                class="font-bold text-indigo-700 dark:text-indigo-300 text-xs block">
                                                                {{ $child->name }}
                                                            </span>
                                                            <span
                                                                class="text-[10px] text-indigo-500 dark:text-indigo-400 block leading-none">
                                                                {{ $child->class_name }} | NIS: {{ $child->nis }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-red-500 italic">Tidak ada data siswa</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-gray-500 text-xs">
                                        {{ $user->created_at->format('d M Y') }}
                                        <br>
                                        {{ $user->created_at->format('H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            {{-- Form Approve --}}
                                            <form method="POST" action="{{ route('admin.wali.approve', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700 transition shadow-sm hover:shadow-md">
                                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- Form Reject --}}
                                            <form method="POST" action="{{ route('admin.wali.reject', $user->id) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menolak? Data siswa akan dilepas dari akun ini.');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-rose-600 text-white text-xs font-semibold hover:bg-rose-700 transition shadow-sm hover:shadow-md">
                                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                                            <p>Tidak ada wali murid yang menunggu persetujuan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($wali->hasPages())
                <div class="pt-6">
                    {{ $wali->links() }}
                </div>
            @endif

        </div>
    </section>
</x-admin-layout>
