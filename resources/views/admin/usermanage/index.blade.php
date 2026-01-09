<x-admin-layout>
    <x-slot:title>Approval Wali Murid</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Persetujuan Akun Wali Murid
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Kelola pendaftaran akun orang tua/wali murid.
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
                                <th class="px-4 py-3 text-left font-semibold">Tanggal Daftar</th>
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
                                    <td class="px-4 py-3 text-gray-500 text-xs">
                                        {{ $user->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('admin.wali.approve', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-3 py-1.5 rounded-full bg-green-600 text-white text-xs font-semibold hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.wali.reject', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-3 py-1.5 rounded-full bg-red-600 text-white text-xs font-semibold hover:bg-red-700">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada wali murid yang menunggu persetujuan.
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
