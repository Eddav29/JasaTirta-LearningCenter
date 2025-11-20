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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialization');
            $table->string('education');
            $table->string('experience', 50);
            $table->text('bio');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('image')->nullable();
            $table->enum('instructor_type', ['internal', 'vendor']);
            $table->string('company')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('instructor_type');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
