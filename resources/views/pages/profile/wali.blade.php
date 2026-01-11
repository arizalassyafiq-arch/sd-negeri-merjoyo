<x-main-layout>
    <div class="pt-32 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb Sederhana --}}
        <nav class="flex items-center gap-2 mb-8 text-sm">
            <a href="/" class="text-slate-500 hover:text-primary transition-colors">Beranda</a>
            <span class="text-slate-400">/</span>
            <span class="text-primary font-bold">Pengaturan Profil</span>
        </nav>

        {{-- Container Utama dengan Alpine.js (Sama persis dengan Admin) --}}
        <div x-data="{
            photoPreview: null,
            showConfirmProfile: false,
            showConfirmPassword: false,
            setupPreview(event) {
                const file = event.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div
                    class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 dark:bg-green-900/20 dark:text-green-400 flex items-center gap-3 rounded-r-lg shadow-sm animate-fade-in-up">
                    <span class="material-symbols-outlined">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Form Data Diri --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- FORM PROFIL --}}
                    <form id="profileForm" method="post" action="{{ route('profile.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div
                            class="bg-white dark:bg-surface-dark rounded-3xl p-8 shadow-lg border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:border-primary/30 transition-all duration-300">
                            {{-- Dekorasi Background --}}
                            <div
                                class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl group-hover:bg-primary/10 transition-all">
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 relative z-10">Informasi
                                Akun</h3>
                            <p class="text-slate-500 text-sm mb-8 relative z-10">Perbarui foto profil dan data diri Anda
                                di sini.</p>

                            <div class="flex flex-col md:flex-row items-start gap-8 mb-10 relative z-10">
                                {{-- Avatar Section --}}
                                <div class="flex flex-col items-center gap-4">
                                    <div class="relative group/avatar">
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-2xl size-32 border-4 {{ $errors->has('avatar') ? 'border-red-500' : 'border-white dark:border-slate-700' }} shadow-xl transition-transform group-hover/avatar:scale-105"
                                            :style="photoPreview ? `background-image: url('${photoPreview}')` :
                                                `background-image: url('{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=10b981&color=fff' }}')`">
                                        </div>

                                        <label for="avatarInput"
                                            class="absolute -bottom-3 -right-3 bg-primary text-white p-2.5 rounded-xl shadow-lg hover:bg-primary-hover transition-all cursor-pointer hover:scale-110 hover:rotate-3">
                                            <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                                        </label>
                                        <input type="file" name="avatar" id="avatarInput" class="hidden"
                                            accept="image/png, image/jpeg, image/jpg, image/webp"
                                            @change="setupPreview($event)">
                                    </div>
                                    @error('avatar')
                                        <span
                                            class="text-red-500 text-xs font-bold text-center bg-red-50 px-2 py-1 rounded-md">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Inputs --}}
                                <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="w-full bg-slate-50 dark:bg-black/20 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                                        @error('name')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email
                                            Address</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="w-full bg-slate-50 dark:bg-black/20 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                                        @error('email')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Role
                                            Akun</label>
                                        <input type="text" value="{{ ucfirst($user->role) }}" readonly
                                            class="w-full bg-slate-100 dark:bg-slate-800 border-transparent rounded-xl px-4 py-3 text-slate-500 cursor-not-allowed font-medium">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-800">
                                <button type="button" @click="showConfirmProfile = true"
                                    class="bg-primary hover:bg-primary-hover text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-primary/30 hover:shadow-primary/50 transition-all transform hover:-translate-y-1">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- FORM PASSWORD --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-3xl p-8 shadow-lg border border-slate-100 dark:border-slate-800">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">lock</span> Keamanan Akun
                        </h3>

                        <form id="passwordForm" method="post" action="{{ route('profile.password') }}"
                            class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @csrf
                            @method('PUT')

                            <div class="col-span-1 md:col-span-2 space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password Saat
                                    Ini</label>
                                <input type="password" name="current_password"
                                    class="w-full bg-slate-50 dark:bg-black/20 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                @error('current_password', 'updatePassword')
                                    <p class="text-red-500 text-xs flex items-center gap-1 mt-1"><span
                                            class="material-symbols-outlined text-[14px]">error</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password
                                    Baru</label>
                                <input type="password" name="password"
                                    class="w-full bg-slate-50 dark:bg-black/20 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                @error('password', 'updatePassword')
                                    <p class="text-red-500 text-xs flex items-center gap-1 mt-1"><span
                                            class="material-symbols-outlined text-[14px]">error</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Konfirmasi
                                    Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-slate-50 dark:bg-black/20 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <div class="col-span-1 md:col-span-2 flex justify-end mt-4">
                                <button type="button" @click="showConfirmPassword = true"
                                    class="bg-slate-800 dark:bg-slate-700 hover:bg-slate-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Info Tambahan --}}
                <div class="space-y-6">
                    <div
                        class="bg-gradient-to-br from-primary to-emerald-600 rounded-3xl p-6 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl">
                        </div>
                        <h4 class="font-bold text-lg mb-2">Status Akun</h4>
                        <div class="flex items-center gap-3 bg-white/20 p-3 rounded-xl backdrop-blur-sm mb-4">
                            <span
                                class="w-3 h-3 bg-green-400 rounded-full animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.5)]"></span>
                            <span class="font-medium text-sm">Aktif & Terverifikasi</span>
                        </div>
                        <p class="text-xs text-white/80 leading-relaxed">
                            Akun Anda terhubung dengan sistem SDN Merjoyo. Anda dapat memantau perkembangan siswa dan
                            berkomunikasi dengan guru.
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-surface-dark rounded-3xl p-6 shadow-lg border border-slate-100 dark:border-slate-800">
                        <h4 class="font-bold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wider">
                            Aktivitas Terakhir</h4>
                        <div class="space-y-4">
                            <div class="flex gap-4 items-start">
                                <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 dark:text-white">Login Terakhir</p>
                                    <p class="text-xs text-slate-500">
                                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Baru saja' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4 items-start">
                                <div
                                    class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-lg text-purple-600 shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">badge</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 dark:text-white">Bergabung Sejak</p>
                                    <p class="text-xs text-slate-500">{{ $user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL KONFIRMASI (Sama dengan Admin tapi Styling disesuaikan Layout Wali) --}}
            <template x-teleport="body">
                <div x-show="showConfirmProfile"
                    class="fixed inset-0 z-[999] flex items-center justify-center overflow-hidden px-4" x-cloak>
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                        @click="showConfirmProfile = false"></div>

                    <div
                        class="relative w-full max-w-md bg-white dark:bg-surface-dark rounded-3xl shadow-2xl p-6 transform transition-all border border-slate-100 dark:border-slate-700">
                        <div class="text-center mb-6">
                            <div
                                class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl">save</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Simpan Perubahan?</h3>
                            <p class="text-slate-500 text-sm mt-2">Pastikan data yang Anda masukkan sudah benar sebelum
                                disimpan.</p>
                        </div>
                        <div class="flex gap-3">
                            <button @click="showConfirmProfile = false"
                                class="flex-1 py-3 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-semibold hover:bg-slate-200 transition-colors">Batal</button>
                            <button @click="document.getElementById('profileForm').submit()"
                                class="flex-1 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-hover shadow-lg shadow-primary/20 transition-all">Ya,
                                Simpan</button>
                        </div>
                    </div>
                </div>
            </template>

            <template x-teleport="body">
                <div x-show="showConfirmPassword"
                    class="fixed inset-0 z-[999] flex items-center justify-center overflow-hidden px-4" x-cloak>
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                        @click="showConfirmPassword = false"></div>

                    <div
                        class="relative w-full max-w-md bg-white dark:bg-surface-dark rounded-3xl shadow-2xl p-6 transform transition-all border border-slate-100 dark:border-slate-700">
                        <div class="text-center mb-6">
                            <div
                                class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl">lock_reset</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Ubah Password?</h3>
                            <p class="text-slate-500 text-sm mt-2">Anda harus login ulang setelah password berhasil
                                diubah.</p>
                        </div>
                        <div class="flex gap-3">
                            <button @click="showConfirmPassword = false"
                                class="flex-1 py-3 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-semibold hover:bg-slate-200 transition-colors">Batal</button>
                            <button @click="document.getElementById('passwordForm').submit()"
                                class="flex-1 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 shadow-lg shadow-red-600/20 transition-all">Ganti
                                Password</button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
</x-main-layout>
