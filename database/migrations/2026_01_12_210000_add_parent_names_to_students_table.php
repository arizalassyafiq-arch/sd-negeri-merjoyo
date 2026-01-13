<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hasFatherName = Schema::hasColumn('students', 'father_name');
        $hasMotherName = Schema::hasColumn('students', 'mother_name');

        if ($hasFatherName && $hasMotherName) {
            return;
        }

        Schema::table('students', function (Blueprint $table) use ($hasFatherName, $hasMotherName) {
            if (! $hasFatherName) {
                $table->string('father_name')->nullable();
            }
            if (! $hasMotherName) {
                $table->string('mother_name')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'father_name')) {
                $table->dropColumn('father_name');
            }
            if (Schema::hasColumn('students', 'mother_name')) {
                $table->dropColumn('mother_name');
            }
        });
    }
};
