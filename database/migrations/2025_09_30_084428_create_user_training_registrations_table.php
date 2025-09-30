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
        Schema::create('user_training_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_schedule_id')->constrained('training_schedules')->onDelete('cascade');
            $table->timestamp('registration_date')->useCurrent();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
            
            // Add indexes
            $table->index('user_id');
            $table->index('training_schedule_id');
            $table->index('status');
            $table->index('registration_date');
            $table->unique(['user_id', 'training_schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_training_registrations');
    }
};
