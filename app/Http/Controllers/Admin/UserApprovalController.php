<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserApprovalController extends Controller
{
    // LIST WALI PENDING
    public function index()
    {
        $wali = User::where('role', 'wali')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.usermanage.index', compact('wali'));
    }

    // APPROVE
    public function approve(User $user)
    {
        if ($user->role !== 'wali') {
            abort(403);
        }

        $user->update([
            'status' => 'active',
        ]);

        return back()->with('status', 'Wali murid berhasil disetujui.');
    }

    // REJECT
    public function reject(User $user)
    {
        if ($user->role !== 'wali') {
            abort(403);
        }

        $user->update([
            'status' => 'rejected',
        ]);

        return back()->with('status', 'Wali murid berhasil ditolak.');
    }
}
