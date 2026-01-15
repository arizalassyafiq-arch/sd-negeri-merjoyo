<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "Kelas 1", "Kelas 6A"

            // Relasi ke Guru (Wali Kelas)
            // nullable() karena bisa jadi kelas dibuat dulu, wali kelasnya menyusul
            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
