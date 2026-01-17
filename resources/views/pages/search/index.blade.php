<x-main-layout>
    <div
        class="relative min-h-screen flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 overflow-hidden font-sans">

        {{-- Background Effects --}}
        <div class="absolute inset-0 w-full h-full overflow-hidden z-0">
            <div
                class="absolute top-0 left-0 w-full h-full bg-linear-to-br from-emerald-500 via-teal-600 to-emerald-800 dark:from-gray-900 dark:via-emerald-900 dark:to-black">
            </div>
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-yellow-300/10 rounded-full blur-3xl"></div>
        </div>

        <main
            class="relative z-10 w-full max-w-7xl mt-15 md:mt-25 px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row items-center gap-12 lg:gap-20 mb-20">

            {{-- Left Content --}}
            <div class="w-full md:w-1/2 text-white space-y-8 text-center md:text-left animate-fade-in-up">
                <div
                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm border border-white/30 px-4 py-1.5 rounded-full text-sm font-medium text-emerald-50 shadow-sm">
                    <span class="material-icons-round text-base">search</span>
                    <span>Pencarian Data Siswa</span>
                </div>

                <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight leading-tight drop-shadow-md">
                    Pantau Hasil <br class="hidden md:block" />
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-yellow-200 to-emerald-200">
                        Belajar Siswa
                    </span>
                </h1>

                <p class="text-lg text-emerald-50/90 font-light leading-relaxed max-w-lg mx-auto md:mx-0">
                    Akses rapor digital dan riwayat akademik putra-putri Anda dengan mudah. Cukup masukkan Nomor Induk
                    Kependudukan (NIK) yang terdaftar.
                </p>

                <div
                    class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 shadow-lg flex items-start gap-4 hover:bg-white/15 transition-colors duration-300 text-left">
                    <div class="bg-emerald-500/80 p-2.5 rounded-xl shadow-inner shrink-0 text-white">
                        <span class="material-icons-round">verified_user</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-base mb-1">Privasi Terjamin</h3>
                        <p class="text-sm text-emerald-100/80">
                            Data siswa hanya dapat diakses oleh Wali Murid yang akunnya telah terverifikasi.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Content (Form) --}}
            <div class="w-full md:w-1/2 max-w-md mx-auto">
                <div
                    class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700 relative">

                    <div class="absolute top-0 left-0 w-full h-2 bg-linear-to-r from-emerald-400 to-teal-500"></div>

                    <div class="p-8 md:p-10">
                        <div class="text-center mb-8">
                            <div
                                class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <span class="material-icons-round text-3xl">school</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Cek Rapor Digital</h2>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Lengkapi data berikut untuk masuk
                            </p>
                        </div>

                        {{-- Alert Error --}}
                        @if ($errors->any())
                            <div class="mb-6 rounded-xl border border-rose-500/20 bg-rose-500/10 p-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-icons-round text-rose-500">error</span>
                                    <div class="text-sm text-rose-600 dark:text-rose-400">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('wali.academic.check') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="space-y-1.5">
                                <label for="nik"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 ml-1">
                                    Nomor Induk Kependudukan (NIK)
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span
                                            class="material-icons-round text-gray-400 group-focus-within:text-emerald-500 transition-colors">badge</span>
                                    </div>
                                    <input type="text" id="nik" name="nik" pattern="[0-9]{16}"
                                        placeholder="16 digit angka sesuai KK..." required value="{{ old('nik') }}"
                                        title="Mohon masukkan 16 digit NIK yang valid"
                                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all outline-none text-sm shadow-sm" />
                                </div>
                                <p class="text-xs text-gray-400 ml-1 flex items-center gap-1">
                                    <span class="material-icons-round text-[14px]">info</span>
                                    Pastikan 16 digit angka benar
                                </p>
                            </div>

                            <button type="submit"
                                class="w-full relative overflow-hidden group bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                <div
                                    class="absolute inset-0 w-full h-full bg-linear-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer">
                                </div>
                                <span class="flex items-center justify-center gap-2 relative z-10">
                                    <span class="material-icons-round">search</span>
                                    Lihat Hasil Belajar
                                </span>
                            </button>
                        </form>

                        {{-- <div class="mt-8 text-center">
                            <a href="#"
                                class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                                <span>Lupa NIK? Hubungi Tata Usaha</span>
                                <span class="material-icons-round text-sm">arrow_forward</span>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>

        </main>

        {{-- Wave SVG (Footer) --}}
        <div class="absolute bottom-0 w-full z-10">
            <svg class="w-full h-24 md:h-32 text-white dark:text-gray-900 fill-current" preserveAspectRatio="none"
                viewBox="0 0 1440 320">
                <path fill-opacity="1"
                    d="M0,128L48,144C96,160,192,192,288,186.7C384,181,480,139,576,133.3C672,128,768,160,864,165.3C960,171,1056,149,1152,133.3C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>

    <style>
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        .animate-shimmer {
            animation: shimmer 1.5s infinite;
        }
    </style>
</x-main-layout>
