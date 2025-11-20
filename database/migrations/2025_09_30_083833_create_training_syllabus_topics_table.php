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
        Schema::create('training_syllabus_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('syllabus_id')->constrained('training_syllabus')->onDelete('cascade');
            $table->string('topic');
            $table->integer('order_number');
            $table->timestamps();

            // Add indexes
            $table->index(['syllabus_id', 'order_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_syllabus_topics');
    }
};
