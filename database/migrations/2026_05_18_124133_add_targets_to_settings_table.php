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
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('target_harian', 15, 2)->default(500000);
            $table->decimal('target_mingguan', 15, 2)->default(3500000);
            $table->decimal('target_bulanan', 15, 2)->default(15000000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['target_harian', 'target_mingguan', 'target_bulanan']);
        });
    }
};
