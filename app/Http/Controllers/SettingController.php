<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate([], [
            'nama_toko' => 'K20 Laundry',
            'alamat' => 'Alamat Belum Diatur',
            'nomor_telepon' => '081234567890',
            'pesan_struk' => 'Terima kasih telah menggunakan jasa kami.',
            'target_harian' => 500000,
            'target_mingguan' => 3500000,
            'target_bulanan' => 15000000,
        ]);
        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'target_harian' => 'required|numeric|min:0',
        ]);

        $setting = Setting::updateOrCreate([], $request->all());

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
