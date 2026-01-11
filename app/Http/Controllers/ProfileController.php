<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();

        // LOGIKA PEMISAH VIEW
        if ($user->role === 'admin') {
            // Tampilan Layout Dashboard (Sidebar)
            return view('pages.profile.index', compact('user'));
        } else {
            // Tampilan Layout Public (Navbar Biasa untuk Wali/Guru)
            return view('pages.profile.wali', compact('user'));
        }
    }

    /**
     * Memperbarui profil user (Nama, Email, Avatar).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            // Pesan ramah untuk orang tua
            'avatar.image' => 'File harus berupa foto.',
            'avatar.mimes' => 'Hanya boleh foto dengan format JPG, PNG, atau WebP.',
            'avatar.max' => 'Ukuran foto terlalu besar (maksimal 2MB).',
        ]);

        if ($request->hasFile('avatar')) {
            // 1. Hapus gambar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 2. Inisialisasi Image Manager
            $manager = new ImageManager(new Driver());

            // 3. Baca gambar yang diunggah
            $image = $manager->read($request->file('avatar'));

            // 4. (Opsional) Resize gambar agar tidak terlalu besar (misal max 500px)
            // Ini akan sangat menghemat memori VPS Anda
            $image->scale(width: 500);

            // 5. Encode ke format WebP dengan kualitas 80%
            $encoded = $image->toWebp(80);

            // 6. Buat nama file unik dengan ekstensi .webp
            $filename = 'avatars/' . hexdec(uniqid()) . '.webp';

            // 7. Simpan ke Storage
            Storage::disk('public')->put($filename, $encoded);

            $validated['avatar'] = $filename;
        }

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    // Method baru untuk Update Password
    // Method baru untuk Update Password
    public function updatePassword(Request $request)
    {
        // Menggunakan bag 'updatePassword' agar error terpisah
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8) // Minimal 8 karakter
                    ->letters()      // Harus ada huruf
                    ->mixedCase()    // Harus ada huruf besar & kecil
                    ->numbers()      // Harus ada angka
                // ->symbols()   // (Opsional) Jika ingin mewajibkan simbol
            ],
        ], [
            // --- PESAN KUSTOM ---
            'current_password.current_password' => 'Password saat ini tidak sesuai.',

            'password.required'  => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password baru harus minimal 8 karakter.',

            // Pesan spesifik untuk aturan Password::defaults()
            'password.letters' => 'Password harus mengandung setidaknya satu huruf.',
            'password.mixed'   => 'Password harus mengandung kombinasi huruf besar dan kecil.',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka.',
        ]);

        $user = Auth::user();
        /** @var User $user */
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Password berhasil diperbarui!');
    }
    /**
     * Menghapus akun user sendiri.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Validasi password sebelum hapus (Opsional tapi SANGAT DISARANKAN untuk keamanan)
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        // 1. Hapus foto profil fisik dari storage jika ada
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // 2. Logout user
        Auth::logout();

        // 3. Hapus data user dari database
        /** @var User $user */
        $user->delete();

        // 4. Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda telah dihapus.');
    }
}
