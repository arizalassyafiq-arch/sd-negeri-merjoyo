<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            // Ini kuncinya: Menghubungkan ke tabel 'users' yang Anda kirim
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data khusus guru yang tidak ada di tabel users
            $table->string('subject')->nullable(); // Mata Pelajaran
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
