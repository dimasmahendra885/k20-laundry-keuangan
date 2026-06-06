<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pengeluaran;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        // Sample Pelanggan
        $p1 = Pelanggan::create([
            'nama' => 'Budi Santoso',
            'nomor_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10',
        ]);

        $p2 = Pelanggan::create([
            'nama' => 'Siti Aminah',
            'nomor_hp' => '089876543210',
            'alamat' => 'Perum Indah Blok C',
        ]);

        // Sample Transaksi
        Transaksi::create([
            'kode_transaksi' => 'TRX-' . date('YmdHis', strtotime('-1 day')),
            'pelanggan_id' => $p1->id,
            'tanggal_masuk' => date('Y-m-d', strtotime('-1 day')),
            'berat_kg' => 5,
            'harga' => 35000,
            'total_bayar' => 35000,
            'metode_pembayaran' => 'tunai',
            'status_pembayaran' => 'lunas',
            'status_cucian' => 'selesai',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-' . date('YmdHis'),
            'pelanggan_id' => $p2->id,
            'tanggal_masuk' => date('Y-m-d'),
            'berat_kg' => 3.5,
            'harga' => 24500,
            'total_bayar' => 24500,
            'metode_pembayaran' => 'transfer',
            'status_pembayaran' => 'belum_lunas',
            'status_cucian' => 'proses',
        ]);

        // Sample Pengeluaran
        Pengeluaran::create([
            'tanggal' => date('Y-m-d'),
            'kategori' => 'Deterjen',
            'nominal' => 50000,
            'keterangan' => 'Beli deterjen 5kg',
        ]);

        Pengeluaran::create([
            'tanggal' => date('Y-m-d'),
            'kategori' => 'Listrik',
            'nominal' => 200000,
            'keterangan' => 'Bayar listrik bulanan',
        ]);
    }
}
