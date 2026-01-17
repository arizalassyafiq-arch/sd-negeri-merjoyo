<?php

// database/migrations/xxxx_xx_xx_create_articles_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('published_at')->nullable();

            // Foreign Key ke Users (Author)
            $table->foreignId('author_id')
                ->constrained('users')
                ->onDelete('cascade'); // Jika user dihapus, artikel ikut terhapus

            $table->timestamps();

            // Index
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
