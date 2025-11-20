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
        Schema::table('user_training_registrations', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('status');
            $table->enum('payment_status', ['unpaid', 'pending_verification', 'paid', 'refunded'])
                ->default('unpaid')
                ->after('payment_proof');
            $table->decimal('payment_amount', 10, 2)->nullable()->after('payment_status');
            $table->text('notes')->nullable()->after('payment_amount');
            $table->text('rejected_reason')->nullable()->after('notes');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete()->after('rejected_reason');
            $table->timestamp('verified_at')->nullable()->after('verified_by');

            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_training_registrations', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropIndex(['payment_status']);
            $table->dropColumn([
                'payment_proof',
                'payment_status',
                'payment_amount',
                'notes',
                'rejected_reason',
                'verified_by',
                'verified_at',
            ]);
        });
    }
};
