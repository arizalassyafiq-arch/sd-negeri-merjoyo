<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Data Admin
        $admins = [
            [
                'name' => 'Administrator Utama',
                'email' => 'admin@sekolah.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff Tata Usaha',
                'email' => 'tu@sekolah.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepsek@sekolah.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
            ]
        ];

        // Loop untuk insert data
        foreach ($admins as $adminData) {
            User::create($adminData);
        }
    }
}
