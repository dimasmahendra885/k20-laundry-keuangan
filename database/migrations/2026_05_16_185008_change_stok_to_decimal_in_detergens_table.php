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
        Schema::table('detergens', function (Blueprint $table) {
            $table->decimal('stok', 12, 2)->change();
        });

        Schema::table('riwayat_detergens', function (Blueprint $table) {
            $table->decimal('jumlah', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detergens', function (Blueprint $table) {
            $table->integer('stok')->change();
        });

        Schema::table('riwayat_detergens', function (Blueprint $table) {
            $table->integer('jumlah')->change();
        });
    }
};
