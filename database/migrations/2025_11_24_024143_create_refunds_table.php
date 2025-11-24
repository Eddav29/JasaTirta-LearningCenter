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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_training_registration_id')->constrained('user_training_registrations')->cascadeOnDelete();
            $table->decimal('refund_amount', 12, 2);
            $table->enum('refund_method', ['bank_transfer', 'cash', 'ewallet', 'other'])->default('bank_transfer');
            $table->enum('refund_status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->string('refund_proof')->nullable();
            $table->text('refund_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
