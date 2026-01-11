<x-admin-layout>
    <x-slot:title>User Profile Settings</x-slot>

    {{-- Container Utama dengan Alpine.js untuk Logika Preview --}}
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
                class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 dark:bg-green-900/20 dark:text-green-400 flex items-center gap-3 rounded-r-lg shadow-sm">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <nav class="flex items-center gap-2 mb-6">
            <a class="text-slate-500 dark:text-slate-400 text-sm font-medium hover:text-admin-primary transition-colors"
                href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <span class="text-slate-400 text-sm">/</span>
            <span class="text-admin-primary text-sm font-semibold">User Profile</span>
        </nav>

        {{-- FORM UTAMA: Menggabungkan Avatar dan Data Akun --}}
        <form method="post" id="profileForm" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Header Profil & Foto --}}
            <div
                class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm mb-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-admin-primary/5 rounded-full -mr-16 -mt-16 blur-2xl">
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                    <div class="flex flex-col md:flex-row items-center gap-6">

                        <div class="flex flex-col items-center gap-3"> {{-- Wrapper baru untuk foto & error --}}
                            <div class="relative group">
                                {{-- Tampilan Foto --}}
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-28 md:size-32 border-4 {{ $errors->has('avatar') ? 'border-red-500' : 'border-slate-50 dark:border-slate-800' }} shadow-md transition-transform group-hover:scale-105"
                                    :style="photoPreview ? `background-image: url('${photoPreview}')` :
                                        `background-image: url('{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=135bec&color=fff' }}')`">
                                </div>

                                <label for="avatarInput"
                                    class="absolute bottom-1 right-1 bg-admin-primary text-white p-2 rounded-full border-4 border-white dark:border-slate-900 shadow-lg hover:bg-admin-primary-hover transition-all cursor-pointer hover:scale-110">
                                    <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                                </label>

                                <input type="file" name="avatar" id="avatarInput" class="hidden"
                                    accept="image/png, image/jpeg, image/jpg, image/webp"
                                    @change="setupPreview($event)">
                            </div>

                            {{-- PESAN ERROR FORMAT GAMBAR --}}
                            @error('avatar')
                                <div
                                    class="flex items-center gap-1.5 px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-full border border-red-100 dark:border-red-800/50 animate-bounce-slow">
                                    <span class="material-symbols-outlined text-[16px]">warning</span>
                                    <span class="text-[11px] font-bold uppercase tracking-tight">Format Salah:
                                        {{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="text-center md:text-left">
                            <div class="flex items-center justify-center md:justify-start gap-3 mb-1">
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white font-display">
                                    {{ $user->name }}
                                </h3>
                                <span
                                    class="bg-admin-primary/10 text-admin-primary text-[11px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full border border-admin-primary/20">
                                    {{ $user->role ?? 'User' }}
                                </span>
                            </div>
                            <p
                                class="text-slate-500 dark:text-slate-400 flex items-center justify-center md:justify-start gap-1.5 text-sm mb-3">
                                {{ $user->email }}
                                @if ($user->email_verified_at)
                                    <span class="material-symbols-outlined text-green-500 text-[18px] fill-current"
                                        title="Verified Account">check_circle</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('nameInput').focus()"
                        class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white font-bold rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                        Edit Details
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 flex flex-col gap-6">

                    {{-- Section: Informasi Akun --}}
                    <section
                        class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="p-5 border-b border-slate-100 dark:border-slate-800">
                            <h4 class="text-lg font-bold text-slate-800 dark:text-white font-display">Account
                                Information</h4>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <label
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Full
                                        Name</label>
                                    <input type="text" name="name" id="nameInput"
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-lg px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-admin-primary/50 font-medium">
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email
                                        Address</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-lg px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-admin-primary/50 font-medium">
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="space-y-1">
                                    <label
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Phone
                                        Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                        placeholder="+62..."
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-lg px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-admin-primary/50 font-medium">
                                </div> --}}

                                <div class="space-y-1">
                                    <label
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</label>
                                    <div
                                        class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-lg px-4 py-2.5 text-slate-500 dark:text-slate-400 font-medium cursor-not-allowed">
                                        {{ ucfirst($user->role) }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="button" @click="showConfirmProfile = true"
                                    class="bg-admin-primary hover:bg-admin-primary-hover text-white font-bold py-2.5 px-6 rounded-lg transition-colors shadow-lg shadow-admin-primary/20">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </section>
        </form>

        {{-- Section: Keamanan / Password --}}
        <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="p-5 border-b border-slate-100 dark:border-slate-800">
                <h4 class="text-lg font-bold text-slate-800 dark:text-white font-display">Security Settings</h4>
            </div>

            <div class="p-6">
                <h5 class="text-sm font-semibold mb-4 text-slate-800 dark:text-white">Change Password</h5>

                <form method="post" id="passwordForm" action="{{ route('profile.password') }}"
                    class="grid grid-cols-1 gap-5 max-w-xl">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-500 dark:text-slate-400">Current Password</label>
                        <input type="password" name="current_password"
                            class="w-full bg-white dark:bg-slate-800 border rounded-lg px-4 py-2.5 focus:border-admin-primary focus:ring-1 focus:ring-admin-primary outline-none dark:text-white transition-all {{ $errors->updatePassword->has('current_password') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }}"
                            placeholder="••••••••" />
                        @error('current_password', 'updatePassword')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- New Password --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-500 dark:text-slate-400">New Password</label>
                            <input type="password" name="password"
                                class="w-full bg-white dark:bg-slate-800 border rounded-lg px-4 py-2.5 focus:border-admin-primary focus:ring-1 focus:ring-admin-primary outline-none dark:text-white transition-all {{ $errors->updatePassword->has('password') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }}"
                                placeholder="••••••••" />
                            @error('password', 'updatePassword')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-500 dark:text-slate-400">Confirm New
                                Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 focus:border-admin-primary focus:ring-1 focus:ring-admin-primary outline-none dark:text-white transition-all"
                                placeholder="••••••••" />
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="button" @click="showConfirmPassword = true"
                            class="bg-slate-900 dark:bg-slate-700 hover:bg-slate-800 text-white font-bold py-2.5 px-6 rounded-lg transition-colors">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    {{-- Sidebar Stats & Role --}}
    <div class="flex flex-col gap-6">
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 mb-4">
                Current
                Role</h4>
            <div class="flex items-center gap-4 p-4 rounded-xl bg-admin-primary/5 border border-admin-primary/10">
                <div class="bg-admin-primary text-white size-12 rounded-lg flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">shield_person</span>
                </div>
                <div>
                    <p class="text-admin-primary font-bold">{{ ucfirst($user->role) }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Access Level: High</p>
                </div>
            </div>

            <div class="mt-4 space-y-3">
                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                    <span class="material-symbols-outlined text-green-500 text-[18px]">check_circle</span>
                    Dashboard Access
                </div>
                @if ($user->role === 'admin')
                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-[18px]">check_circle</span>
                        User
                        Management
                    </div>
                @endif
                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                    <span class="material-symbols-outlined text-green-500 text-[18px]">check_circle</span>
                    Article
                    Publishing
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 mb-4">
                System
                Activity</h4>
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="size-2 rounded-full bg-admin-primary mt-2"></div>
                        <div class="w-0.5 h-full bg-slate-100 dark:bg-slate-800"></div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 dark:text-white">Profile Viewed</p>
                        <p class="text-xs text-slate-500">Just now</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="size-2 rounded-full bg-slate-300 dark:bg-slate-600 mt-2"></div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 dark:text-white">Last Login</p>
                        <p class="text-xs text-slate-500">
                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum pernah login' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <template x-teleport="body">
        <div x-show="showConfirmProfile" class="fixed inset-0 z-99 flex items-center justify-center overflow-hidden"
            x-cloak>
            {{-- Backdrop --}}
            <div x-show="showConfirmProfile" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="showConfirmProfile = false"
                class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            {{-- Modal Card --}}
            <div x-show="showConfirmProfile" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-md p-6 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800">

                <div class="flex flex-col items-center text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-blue-50 dark:bg-blue-900/20 text-admin-primary">
                        <span class="material-symbols-outlined text-3xl">info</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Simpan Perubahan?</h3>
                    <p class="mt-2 text-slate-500 dark:text-slate-400">Apakah Anda yakin ingin memperbarui informasi
                        profil
                        Anda? Data lama akan digantikan dengan data baru.</p>
                </div>

                <div class="mt-8 flex gap-3">
                    <button @click="showConfirmProfile = false"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        Batal
                    </button>
                    {{-- Ganti 'profileForm' dengan ID form profil Anda --}}
                    <button @click="document.getElementById('profileForm').submit()"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-admin-primary rounded-xl hover:bg-admin-primary-hover shadow-lg shadow-admin-primary/25 transition-all">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </template>

    {{-- MODAL KONFIRMASI UPDATE PASSWORD --}}
    <template x-teleport="body">
        <div x-show="showConfirmPassword" class="fixed inset-0 z-99 flex items-center justify-center overflow-hidden"
            x-cloak>
            <div @click="showConfirmPassword = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            <div
                class="relative w-full max-w-md p-6 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-red-50 dark:bg-red-900/20 text-red-600">
                        <span class="material-symbols-outlined text-3xl">lock_reset</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Ganti Password?</h3>
                    <p class="mt-2 text-slate-500 dark:text-slate-400">Pastikan Anda mengingat password baru Anda. Anda
                        akan diminta login kembali setelah perubahan ini.</p>
                </div>

                <div class="mt-8 flex gap-3">
                    <button @click="showConfirmPassword = false"
                        class="flex-1 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl">Batal</button>
                    <button @click="document.getElementById('passwordForm').submit()"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 shadow-lg shadow-red-600/25">Ganti
                        Password</button>
                </div>
            </div>
        </div>
    </template>
</x-admin-layout>

{{-- MODAL KONFIRMASI UPDATE PROFIL --}}
