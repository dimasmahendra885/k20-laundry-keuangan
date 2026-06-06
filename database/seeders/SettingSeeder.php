<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::create([
            'nama_toko' => 'K20 Laundry',
            'alamat' => 'Jl. Contoh No. 1',
            'nomor_telepon' => '08123456789',
            'pesan_struk' => 'Terima kasih telah mencuci di sini',
        ]);
    }
}
