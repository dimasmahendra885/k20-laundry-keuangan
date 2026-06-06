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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->date('tanggal_masuk');
            $table->decimal('berat_kg', 8, 2)->nullable();
            $table->integer('jumlah_item')->nullable();
            $table->decimal('harga', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);
            $table->string('metode_pembayaran'); // tunai, transfer, dll
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status_cucian', ['proses', 'selesai', 'diambil'])->default('proses');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
