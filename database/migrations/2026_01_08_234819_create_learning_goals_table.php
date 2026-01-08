<?php

// database/migrations/xxxx_xx_xx_create_learning_goals_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('class_name');
            
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Di SQL asli learning_goals hanya ada created_at tanpa updated_at
            // tapi di Laravel sebaiknya pakai timestamps() standar
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_goals');
    }
};