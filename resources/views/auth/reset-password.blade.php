<x-auth-layout>
    {{-- Background Decoration --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0">
        <svg class="relative block w-full h-37.5 lg:h-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C45.3,33.47,105.9,62.18,171.19,68.82,217.39,73.52,268.93,66.2,321.39,56.44Z"
                class="fill-primary/20 dark:fill-primary/10 backdrop-blur-sm"></path>
        </svg>
    </div>

    <div class="max-w-md w-full mx-auto z-10 relative">
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/50 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Buat Password Baru</h2>

            {{-- Error Alerts --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                    <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                {{-- Token Wajib (Hidden) --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email (Readonly agar tidak diubah user) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Email</label>
                    <input
                        class="block w-full px-4 py-3 border border-gray-200 bg-gray-100 text-gray-500 rounded-xl sm:text-sm"
                        type="email" name="email" value="{{ $request->email }}" readonly />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                        for="password">Password Baru</label>
                    <div class="relative">
                        <input
                            class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:outline-none transition sm:text-sm"
                            id="password" type="password" name="password" required autofocus
                            placeholder="Minimal 8 karakter" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                        for="password_confirmation">Konfirmasi Password</label>
                    <div class="relative">
                        <input
                            class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:outline-none transition sm:text-sm"
                            id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Ulangi password baru" />
                    </div>
                </div>

                <button
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-secondary hover:bg-gray-800 dark:bg-primary dark:text-gray-900 dark:hover:bg-green-400 transition-all transform hover:-translate-y-0.5"
                    type="submit">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</x-auth-layout>
