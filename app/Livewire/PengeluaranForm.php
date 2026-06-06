<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class PengeluaranForm extends Component
{
    public $pengeluaran_id, $tanggal, $kategori, $nominal, $keterangan;

    public $kategoriList = [
        'Listrik', 'Air', 'Gaji', 'Servis Mesin', 'Lainnya'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $pengeluaran = Pengeluaran::findOrFail($id);
            $this->pengeluaran_id = $id;
            $this->tanggal = $pengeluaran->tanggal->timezone('Asia/Jakarta')->format('Y-m-d');
            $this->kategori = $pengeluaran->kategori;
            $this->nominal = $pengeluaran->nominal;
            $this->keterangan = $pengeluaran->keterangan;
        } else {
            $this->tanggal = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        }
    }

    public function store()
    {
        $this->validate([
            'tanggal' => 'required',
            'kategori' => 'required',
            'nominal' => 'required',
        ]);

        Pengeluaran::updateOrCreate(['id' => $this->pengeluaran_id], [
            'tanggal' => $this->tanggal,
            'kategori' => $this->kategori,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 
            $this->pengeluaran_id ? 'Data Pengeluaran Berhasil Diperbarui.' : 'Data Pengeluaran Berhasil Ditambahkan.');

        return redirect()->route('pengeluaran.index');
    }

    public function render()
    {
        return view('livewire.pengeluaran-form');
    }
}
