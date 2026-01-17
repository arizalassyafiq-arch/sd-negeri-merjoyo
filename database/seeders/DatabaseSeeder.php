<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Article;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            // ClassSeeder::class, (jika ada seeder lain)
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 1. Buat Akun Admin Tetap (Untuk Login Testing)
        // User::create([
        //     'name' => 'Admin Sekolah',
        //     'email' => 'admin@sekolah.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        //     'status' => 'active',
        //     'email_verified_at' => now(),
        // ]);

        // 2. Buat Akun Guru Tetap (Untuk Login Testing)
        // $guruUser = User::create([
        //     'name' => 'Guru Budi',
        //     'email' => 'guru@sekolah.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'guru',
        //     'status' => 'active',
        //     'email_verified_at' => now(),
        // ]);

        // Teacher::create([
        //     'user_id' => $guruUser->id,
        //     'subject' => 'Matematika',
        // ]);

        // 3. Buat 10 Guru Tambahan (Random)
        // Teacher::factory(10)->create();

        // 4. Buat Kelas (Wajib ada sebelum siswa)
        // Kita buat manual Kelas 1 - 6 agar rapi
        // $classrooms = collect();
        // for ($i = 1; $i <= 6; $i++) {
        //     $classrooms->push(Classroom::create(['name' => 'Kelas ' . $i]));
        // }

        // 5. Buat 20 Wali Murid
        // $guardians = User::factory(20)->wali()->create();

        // 6. Buat 100 Siswa
        // Kita distribusikan siswa ke kelas dan wali secara acak
        // Student::factory(100)->make()->each(function ($student) use ($classrooms, $guardians) {

        // Assign Kelas Acak
        // $student->classroom_id = $classrooms->random()->id;

        // 50% kemungkinan siswa punya akun wali yang terhubung
        // if (rand(0, 1)) {
        //     $student->guardian_id = $guardians->random()->id;
        // }

        //     $student->save();
        // });

        // 7. Buat 15 Artikel Berita
        // Article::factory(15)->create([
        //     // Author ambil acak dari User yg role admin/guru
        //     'author_id' => User::whereIn('role', ['admin', 'guru'])->inRandomOrder()->first()->id
        // ]);
    }
}
