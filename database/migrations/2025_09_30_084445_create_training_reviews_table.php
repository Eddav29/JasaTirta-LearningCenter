<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->unsigned();
            $table->text('review_text')->nullable();
            $table->timestamps();
            
            // Add indexes
            $table->index('user_id');
            $table->index('training_id');
            $table->index('rating');
            $table->unique(['user_id', 'training_id']);
        });
        
        // Add check constraint with raw SQL for SQLite
        DB::statement('ALTER TABLE training_reviews ADD CONSTRAINT check_rating_range CHECK (rating >= 1 AND rating <= 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_reviews');
    }
};
