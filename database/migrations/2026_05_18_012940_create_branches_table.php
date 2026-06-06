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
        Schema::create('branches', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('nama');
            $blueprint->string('alamat')->nullable();
            $blueprint->decimal('target_daily', 15, 2)->default(500000);
            $blueprint->decimal('target_weekly', 15, 2)->default(3500000);
            $blueprint->decimal('target_monthly', 15, 2)->default(15000000);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
