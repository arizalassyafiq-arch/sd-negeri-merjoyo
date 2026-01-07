<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if (Article::count() === 0) {
            $articles = [
                [
                    'title' => 'Tips Mengendalikan Mata Minus pada Anak Bertambah',
                    'excerpt' => 'Orang tua kini makin peduli pada kesehatan mata anak di usia sekolah.',
                    'content' => 'Orang tua kini makin peduli pada kesehatan mata anak di usia sekolah. Mulai dari kebiasaan membaca yang baik, durasi layar, hingga pemeriksaan rutin. Sekolah juga bisa membantu dengan edukasi kebiasaan belajar yang sehat dan aktivitas luar ruangan.',
                    'image_url' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(1),
                ],
                [
                    'title' => 'Terungkap! Penyebab Ilmiah Mengapa Pria Lebih Tinggi',
                    'excerpt' => 'Studi terbaru membahas faktor genetik dan nutrisi pada pertumbuhan.',
                    'content' => 'Studi terbaru membahas faktor genetik dan nutrisi pada pertumbuhan. Selain genetika, pola makan seimbang, olahraga teratur, dan kualitas tidur anak turut berperan besar dalam proses pertumbuhan.',
                    'image_url' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(2),
                ],
                [
                    'title' => 'BGN Klarifikasi Soal Insentif Rp 5 Juta untuk Konten Positif',
                    'excerpt' => 'Informasi insentif konten positif menjadi sorotan di kalangan guru dan siswa.',
                    'content' => 'Informasi insentif konten positif menjadi sorotan di kalangan guru dan siswa. Sekolah dapat memanfaatkan program ini untuk mendorong kreativitas siswa dalam membuat konten edukatif yang bermanfaat.',
                    'image_url' => 'https://images.unsplash.com/photo-1504151932400-72d4384f04b3?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(3),
                ],
                [
                    'title' => 'Layanan Jantung Terintegrasi dan Berkualitas di Rumah Sakit',
                    'excerpt' => 'Pelayanan kesehatan terpadu membantu masyarakat mengakses layanan lebih cepat.',
                    'content' => 'Pelayanan kesehatan terpadu membantu masyarakat mengakses layanan lebih cepat. Dengan koordinasi dokter, perawat, dan fasilitas penunjang, proses penanganan pasien menjadi lebih efektif.',
                    'image_url' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(4),
                ],
                [
                    'title' => 'Mengenal Pola Makan Seimbang untuk Anak Usia Sekolah',
                    'excerpt' => 'Gizi seimbang mendukung konsentrasi dan daya tahan tubuh anak.',
                    'content' => 'Gizi seimbang mendukung konsentrasi dan daya tahan tubuh anak. Orang tua bisa menyiapkan menu harian dengan kombinasi karbohidrat, protein, sayur, dan buah.',
                    'image_url' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(5),
                ],
                [
                    'title' => 'Kegiatan Outing Class: Belajar di Luar Ruang Itu Seru',
                    'excerpt' => 'Outing class memberikan pengalaman belajar baru yang menyenangkan.',
                    'content' => 'Outing class memberikan pengalaman belajar baru yang menyenangkan. Siswa belajar melalui observasi langsung, kerja kelompok, dan refleksi yang meningkatkan rasa ingin tahu mereka.',
                    'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80',
                    'published_at' => now()->subDays(6),
                ],
            ];

            foreach ($articles as $data) {
                Article::create([
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'excerpt' => $data['excerpt'],
                    'content' => $data['content'],
                    'image_url' => $data['image_url'],
                    'published_at' => $data['published_at'],
                ]);
            }
        }
    }
}
