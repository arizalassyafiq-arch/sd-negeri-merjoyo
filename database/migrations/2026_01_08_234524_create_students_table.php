<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nik', 16)->unique();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('class_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');

            $table->string('father_name');
            $table->string('mother_name');

            // Foreign Key ke Users (Wali)
            $table->foreignId('guardian_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null'); // Jika wali dihapus, data siswa tetap ada tapi null

            $table->enum('status', ['active', 'lulus', 'drop_out', 'pindah'])->default('active');

            // Indexing (sesuai request)
            $table->index('name');
            $table->index('nik');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
