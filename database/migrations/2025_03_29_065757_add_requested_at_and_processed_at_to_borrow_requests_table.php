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
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->timestamp('requested_at')->useCurrent()->after('status');
            $table->timestamp('processed_at')->nullable()->after('requested_at');
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->dropColumn(['requested_at', 'processed_at']);
        });
    }
};
