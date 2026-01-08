
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->foreignId('learning_goal_id')
                ->constrained('learning_goals')
                ->onDelete('cascade');

            $table->string('score');
            $table->text('note')->nullable();

            // Asumsi created_by merujuk ke User (Guru)
            $table->foreignId('created_by')->constrained('users');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_outcomes');
    }
};
