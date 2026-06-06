<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pelanggan;

class PelangganForm extends Component
{
    public $pelanggan_id, $nama, $nomor_hp, $alamat, $catatan;

    public function mount($id = null)
    {
        if ($id) {
            $pelanggan = Pelanggan::findOrFail($id);
            $this->pelanggan_id = $id;
            $this->nama = $pelanggan->nama;
            $this->nomor_hp = $pelanggan->nomor_hp;
            $this->alamat = $pelanggan->alamat;
            $this->catatan = $pelanggan->catatan;
        }
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'nomor_hp' => 'required',
        ]);

        Pelanggan::updateOrCreate(['id' => $this->pelanggan_id], [
            'nama' => $this->nama,
            'nomor_hp' => $this->nomor_hp,
            'alamat' => $this->alamat,
            'catatan' => $this->catatan,
        ]);

        session()->flash('message', 
            $this->pelanggan_id ? 'Data Pelanggan Berhasil Diperbarui.' : 'Data Pelanggan Berhasil Ditambahkan.');

        return redirect()->route('pelanggan.index');
    }

    public function render()
    {
        return view('livewire.pelanggan-form');
    }
}
