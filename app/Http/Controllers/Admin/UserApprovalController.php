<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student; // Pastikan Model Student diimport

class UserApprovalController extends Controller
{
    // 1. LIST WALI PENDING (Menunggu Verifikasi)
    public function index()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'pending')
            ->with('students') // Load data siswa
            ->latest()
            ->paginate(10);

        return view('admin.usermanage.index', compact('wali'));
    }

    // 2. LIST WALI AKTIF (Sudah diapprove)
    // Method ini yang menyebabkan error "undefined method active()" sebelumnya karena hilang
    public function active()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'active')
            ->with('students') // Load data siswa
            ->latest()
            ->paginate(10);

        // Pastikan Anda sudah membuat view: resources/views/admin/usermanage/active.blade.php
        // Jika belum punya, bisa copy dari index.blade.php dan sesuaikan isinya
        return view('admin.usermanage.active', compact('wali'));
    }

    // 3. LIST WALI DITOLAK (Rejected)
    public function rejected()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'rejected')
            ->with('students') // Load data siswa
            ->latest()
            ->paginate(10);

        // Pastikan Anda sudah membuat view: resources/views/admin/usermanage/rejected.blade.php
        return view('admin.usermanage.rejected', compact('wali'));
    }

    // ACTION: APPROVE
    public function approve(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        $user->update(['status' => 'active']);
        return back()->with('status', 'Akun berhasil disetujui dan diaktifkan.');
    }

    // ACTION: REJECT
    public function reject(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        // Lepas relasi siswa agar bisa didaftarkan ulang
        Student::where('guardian_id', $user->id)->update(['guardian_id' => null]);

        $user->update(['status' => 'rejected']);

        return back()->with('status', 'Akun ditolak. Data klaim siswa telah di-reset.');
    }

    // ACTION: DELETE
    public function destroy(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        // Lepas relasi siswa sebelum hapus
        Student::where('guardian_id', $user->id)->update(['guardian_id' => null]);

        $user->delete();
        return back()->with('status', 'Data pengguna berhasil dihapus permanen.');
    }
}
