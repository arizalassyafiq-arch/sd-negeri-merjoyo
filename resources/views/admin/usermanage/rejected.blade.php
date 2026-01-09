<x-admin-layout>
    <x-slot:title>Pengajuan Ditolak</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Pengajuan Ditolak
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Daftar akun yang ditolak pendaftarannya.
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
                                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left font-semibold">Email</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($wali as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                            Ditolak
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            {{-- Tombol Pulihkan (Approve) --}}
                                            <form method="POST" action="{{ route('admin.wali.approve', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-3 py-1.5 rounded-full bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition-colors">
                                                    Pulihkan
                                                </button>
                                            </form>

                                            {{-- Tombol Hapus Permanen --}}
                                            <form method="POST" action="{{ route('admin.wali.destroy', $user->id) }}"
                                                onsubmit="return confirm('Yakin hapus permanen? Data tidak bisa kembali.');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-3 py-1.5 rounded-full bg-red-600 text-white text-xs font-semibold hover:bg-red-700 transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data pengajuan ditolak.
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
