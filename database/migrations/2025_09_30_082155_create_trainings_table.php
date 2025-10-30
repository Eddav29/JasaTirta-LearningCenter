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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained('training_categories');
            $table->foreignId('instructor_id')->constrained();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->string('duration', 50);
            $table->decimal('price', 10, 2);
            $table->integer('capacity');
            $table->string('image')->nullable();
            $table->enum('training_type', ['offline', 'online', 'hybrid']);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('review_count')->default(0);
            $table->string('learning_hours', 10)->nullable();
            $table->text('training_methods')->nullable();
            $table->text('certification_note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Add indexes
            $table->index('category_id');
            $table->index('instructor_id');
            $table->index(['is_active', 'price']);
            $table->index('training_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
