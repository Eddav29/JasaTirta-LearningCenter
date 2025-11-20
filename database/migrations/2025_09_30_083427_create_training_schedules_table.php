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
        Schema::create('training_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location');
            $table->enum('method', ['offline', 'online', 'hybrid']);
            $table->integer('total_slots');
            $table->integer('available_slots');
            $table->integer('registered_count')->default(0);
            $table->string('month', 20);
            $table->enum('status', ['buka_pendaftaran', 'tutup_pendaftaran', 'berlangsung', 'penuh', 'selesai']);
            $table->timestamps();

            // Add indexes
            $table->index('training_id');
            $table->index(['start_date', 'end_date']);
            $table->index('status');
            $table->index('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_schedules');
    }
};
