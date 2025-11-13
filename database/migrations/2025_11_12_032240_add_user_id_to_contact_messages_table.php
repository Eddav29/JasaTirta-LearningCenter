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
        Schema::table('contact_messages', function (Blueprint $table) {
            // Add user_id column (nullable for existing records from non-authenticated users)
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');

            // Add read_at timestamp
            $table->timestamp('read_at')->nullable()->after('status');

            // Make name and email nullable since we'll get them from user relationship
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'read_at']);

            // Revert name and email back to not nullable
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
        });
    }
};
