<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Detergen;
use App\Models\RiwayatDetergen;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetergenRestock extends Component
{
    public $detergen_id, $nama_detergen, $jumlah, $tanggal, $keterangan, $harga_total;

    public function mount($id = null)
    {
        if ($id) {
            $detergen = Detergen::findOrFail($id);
            $this->detergen_id = $id;
            $this->nama_detergen = $detergen->nama;
        }
        $this->tanggal = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    }

    public function store()
    {
        $this->validate([
            'jumlah' => 'required|numeric|min:0.01',
            'tanggal' => 'required|date',
            'harga_total' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $detergen = Detergen::findOrFail($this->detergen_id);
            
            // 1. Catat riwayat stok (Selalu dijalankan)
            RiwayatDetergen::create([
                'detergen_id' => $this->detergen_id,
                'jenis' => 'masuk',
                'jumlah' => $this->jumlah,
                'tanggal' => $this->tanggal,
                'keterangan' => $this->keterangan ?: 'Restock ' . $this->nama_detergen,
            ]);

            // 2. Update stok barang (Selalu dijalankan)
            $detergen->increment('stok', $this->jumlah);

            // 3. Catat ke pengeluaran (Hanya jika Harga Total diisi)
            if ($this->harga_total && $this->harga_total > 0) {
                Pengeluaran::create([
                    'tanggal' => $this->tanggal,
                    'kategori' => 'Bahan Baku',
                    'nominal' => $this->harga_total,
                    'keterangan' => 'Restock ' . $this->nama_detergen . ' (' . $this->jumlah . ' ' . $detergen->satuan . ')',
                ]);
            }

            DB::commit();

            if ($this->harga_total && $this->harga_total > 0) {
                session()->flash('message', 'Berhasil! Restock barang telah ditambahkan dan otomatis tercatat di Pengeluaran.');
            } else {
                session()->flash('message', 'Restock Berhasil Dicatat.');
            }

            return redirect()->route('detergen.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.detergen-restock');
    }
}
