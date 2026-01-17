<x-auth-layout>
    {{-- Background SVG Decoration (Sama seperti login) --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0">
        <svg class="relative block w-full h-37.5 lg:h-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C45.3,33.47,105.9,62.18,171.19,68.82,217.39,73.52,268.93,66.2,321.39,56.44Z"
                class="fill-primary/20 dark:fill-primary/10 backdrop-blur-sm"></path>
        </svg>
    </div>

    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center z-10 relative">
        <div class="order-2 lg:order-1 space-y-8">
            <div class="space-y-4 text-center lg:text-left">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-white/30 dark:bg-gray-700/30 text-green-900 dark:text-green-100 text-xs font-semibold tracking-wider uppercase backdrop-blur-sm border border-white/20">
                    Pemulihan Akun
                </span>
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                    Lupa Password? <br />
                    <span class="text-green-800 drop-shadow-sm">Jangan Khawatir.</span>
                </h1>
                <p class="text-gray-800 dark:text-gray-200 text-lg max-w-lg mx-auto lg:mx-0 font-medium">
                    Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk mereset kata sandi Anda.
                </p>
            </div>

            <div
                class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/50 dark:border-gray-700">

                {{-- Alert Sukses (Link Terkirim) --}}
                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 animate-fade-in-down">
                        <div class="flex items-start gap-3">
                            <span class="material-icons-round text-green-600 dark:text-green-400">check_circle</span>
                            <div class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div
                        class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                        <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-200">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            for="email">Alamat Email</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <span class="material-icons-round text-lg">email</span>
                            </span>
                            <input
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 dark:border-gray-600 rounded-xl leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition sm:text-sm shadow-sm"
                                id="email" placeholder="email@anda.com" name="email" type="email"
                                value="{{ old('email') }}" required autofocus />
                        </div>
                    </div>

                    <button
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-secondary hover:bg-gray-800 dark:bg-primary dark:text-gray-900 dark:hover:bg-green-400 transition-all transform hover:-translate-y-0.5"
                        type="submit">
                        Kirim Link Reset
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Sudah ingat password?
                        <a class="font-medium text-secondary dark:text-green-300 hover:text-primary transition-colors"
                            href="{{ route('login') }}">Kembali Login</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Illustration Area --}}
        <div class="order-1 lg:order-2 flex justify-center lg:justify-end relative">
            {{-- Gunakan gambar yang sama atau ilustrasi 'forgot password' jika ada --}}
            <img alt="Forgot Password" class="w-full max-w-md lg:max-w-lg object-contain drop-shadow-2xl animate-float"
                src="{{ asset('img/register.jpeg') }}" />
        </div>
    </div>
</x-auth-layout>
