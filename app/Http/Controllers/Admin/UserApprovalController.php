<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserApprovalController extends Controller
{
    // 1. LIST WALI PENDING (Menunggu Verifikasi)
    public function index()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.usermanage.index', compact('wali'));
    }

    // 2. LIST WALI AKTIF (Sudah diapprove)
    public function active()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'active') // Filter status active
            ->latest()
            ->paginate(10);

        return view('admin.usermanage.active', compact('wali'));
    }

    // 3. LIST WALI DITOLAK (Rejected)
    public function rejected()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'rejected') // Filter status rejected
            ->latest()
            ->paginate(10);

        return view('admin.usermanage.rejected', compact('wali'));
    }

    // ACTION: APPROVE
    public function approve(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        $user->update(['status' => 'active']);
        return back()->with('status', 'Akun berhasil diaktifkan.');
    }

    // ACTION: REJECT
    public function reject(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        $user->update(['status' => 'rejected']);
        return back()->with('status', 'Akun berhasil ditolak/nonaktifkan.');
    }

    // ACTION: DELETE (Hapus Permanen)
    public function destroy(User $user)
    {
        if ($user->role !== 'wali') abort(403);

        $user->delete();
        return back()->with('status', 'Data pengguna berhasil dihapus permanen.');
    }
}
