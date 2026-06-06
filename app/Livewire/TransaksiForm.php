<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Detergen;
use App\Models\RiwayatDetergen;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiForm extends Component
{
    public $transaksi_id, $pelanggan_id, $tanggal_masuk, $berat_kg, $jumlah_item, $harga, $diskon = 0, $total_bayar, $metode_pembayaran, $status_pembayaran, $tanggal_selesai, $status_cucian, $catatan;

    public function mount($id = null)
    {
        if ($id) {
            $transaksi = Transaksi::findOrFail($id);
            $this->transaksi_id = $id;
            $this->pelanggan_id = $transaksi->pelanggan_id;
            $this->tanggal_masuk = $transaksi->tanggal_masuk->timezone('Asia/Jakarta')->format('Y-m-d');
            $this->berat_kg = $transaksi->berat_kg;
            $this->jumlah_item = $transaksi->jumlah_item;
            $this->harga = $transaksi->harga;
            $this->diskon = $transaksi->diskon;
            $this->total_bayar = $transaksi->total_bayar;
            $this->metode_pembayaran = $transaksi->metode_pembayaran;
            $this->status_pembayaran = $transaksi->status_pembayaran;
            $this->tanggal_selesai = $transaksi->tanggal_selesai ? $transaksi->tanggal_selesai->timezone('Asia/Jakarta')->format('Y-m-d') : '';
            $this->status_cucian = $transaksi->status_cucian;
            $this->catatan = $transaksi->catatan;
        } else {
            $this->tanggal_masuk = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $this->status_pembayaran = 'belum_lunas';
            $this->status_cucian = 'proses';
            $this->metode_pembayaran = 'tunai';
        }
    }

    public function updatedBeratKg() { $this->calculateTotal(); }
    public function updatedHarga() { $this->calculateTotal(); }
    public function updatedDiskon() { $this->calculateTotal(); }

    private function calculateTotal()
    {
        $berat = (float)($this->berat_kg ?? 0);
        $hargaSatuan = (float)($this->harga ?? 0);
        $diskon = (float)($this->diskon ?? 0);
        
        $this->total_bayar = ($berat * $hargaSatuan) - $diskon;
    }

    public function store()
    {
        $this->validate([
            'pelanggan_id' => 'required',
            'tanggal_masuk' => 'required',
            'harga' => 'required',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'status_cucian' => 'required',
        ]);

        $this->calculateTotal();

        DB::beginTransaction();
        try {
            if (!$this->transaksi_id) {
                $kode = 'TRX-' . Carbon::now('Asia/Jakarta')->format('YmdHis');
                $isNew = true;
            } else {
                $kode = Transaksi::find($this->transaksi_id)->kode_transaksi;
                $isNew = false;
            }

            $transaksi = Transaksi::updateOrCreate(['id' => $this->transaksi_id], [
                'kode_transaksi' => $kode,
                'pelanggan_id' => $this->pelanggan_id,
                'tanggal_masuk' => $this->tanggal_masuk,
                'berat_kg' => $this->berat_kg,
                'jumlah_item' => $this->jumlah_item,
                'harga' => $this->harga,
                'diskon' => $this->diskon,
                'total_bayar' => $this->total_bayar,
                'metode_pembayaran' => $this->metode_pembayaran,
                'status_pembayaran' => $this->status_pembayaran,
                'tanggal_selesai' => $this->tanggal_selesai ?: null,
                'status_cucian' => $this->status_cucian,
                'catatan' => $this->catatan,
            ]);

            // Pengurangan Stok Otomatis saat Transaksi Baru Dibuat
            if ($isNew && $this->status_cucian == 'proses') {
                $this->potongStok($transaksi);
            }

            DB::commit();
            session()->flash('message', $isNew ? 'Transaksi Berhasil Ditambahkan.' : 'Transaksi Berhasil Diperbarui.');
            return redirect()->route('transaksi.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function potongStok($transaksi)
    {
        $berat = (float)($transaksi->berat_kg ?? 0);
        
        // Konfigurasi pemakaian (Asumsi dalam ml dan pcs)
        $items = [
            'Detergent Liquid' => ['jumlah' => (float)(50 * $berat), 'satuan' => 'ml'],
            'Fabric Softener'  => ['jumlah' => (float)(50 * $berat), 'satuan' => 'ml'],
            'Plastic Bags Large' => ['jumlah' => 1.0, 'satuan' => 'pcs'],
        ];

        foreach ($items as $nama => $data) {
            $detergen = Detergen::where('nama', $nama)->first();
            
            if ($detergen) {
                $jumlahKurang = (float)$data['jumlah'];

                // Logika Konversi: Jika di DB "Liter" tapi hitungan kita "ml"
                if ($data['satuan'] == 'ml' && strtolower($detergen->satuan) == 'liter') {
                    $jumlahKurang = (float)($jumlahKurang / 1000);
                }

                if ((float)$detergen->stok >= $jumlahKurang) {
                    $detergen->decrement('stok', $jumlahKurang);
                    
                    // Catat ke Riwayat Stok
                    RiwayatDetergen::create([
                        'detergen_id' => $detergen->id,
                        'jenis' => 'keluar',
                        'jumlah' => $jumlahKurang,
                        'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                        'keterangan' => 'Pemakaian untuk Transaksi #' . $transaksi->kode_transaksi . ' (Berat: ' . $berat . 'kg)',
                    ]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.transaksi-form', [
            'pelanggans' => Pelanggan::all()
        ]);
    }
}
