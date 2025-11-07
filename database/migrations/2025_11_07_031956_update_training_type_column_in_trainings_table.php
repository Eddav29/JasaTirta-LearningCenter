<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old ENUM column and recreate with correct values
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('training_type');
        });

        Schema::table('trainings', function (Blueprint $table) {
            $table->enum('training_type', ['Beginner', 'Intermediate', 'Advanced', 'Expert'])
                ->default('Beginner')
                ->after('capacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('training_type');
        });

        Schema::table('trainings', function (Blueprint $table) {
            $table->enum('training_type', ['offline', 'online', 'hybrid'])
                ->default('offline')
                ->after('capacity');
        });
    }
};
