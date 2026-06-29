<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Detergen;

class DetergenForm extends Component
{
    public $detergen_id, $nama, $stok, $satuan;

    public function mount($id = null)
    {
        if ($id) {
            $detergen = Detergen::findOrFail($id);
            $this->detergen_id = $id;
            $this->nama = $detergen->nama;
            $this->stok = $detergen->stok;
            $this->satuan = $detergen->satuan;
        } else {
            $this->stok = 0;
            $this->satuan = 'Liter';
        }
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'satuan' => 'required',
        ]);

        $data = [
            'nama' => $this->nama,
            'satuan' => $this->satuan,
        ];

        // Jika data baru, setel stok awal menjadi 0
        if (!$this->detergen_id) {
            $data['stok'] = 0;
        }

        if ($this->detergen_id) {
    // Jika sedang edit data
    Detergen::where('id', $this->detergen_id)->update($data);
} else {
    // Jika sedang tambah data baru
    Detergen::create($data);
}

        session()->flash('message', 
            $this->detergen_id ? 'Data Deterjen Berhasil Diperbarui.' : 'Data Deterjen Berhasil Ditambahkan.');

        return redirect()->route('detergen.index');
    }

    public function render()
    {
        return view('livewire.detergen-form');
    }
}
