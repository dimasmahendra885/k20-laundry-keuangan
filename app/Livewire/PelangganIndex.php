<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelanggan;

class PelangganIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $pelanggans = Pelanggan::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_hp', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.pelanggan-index', [
            'pelanggans' => $pelanggans
        ]);
    }

    public function delete($id)
    {
        Pelanggan::find($id)->delete();
        session()->flash('message', 'Data Pelanggan Berhasil Dihapus.');
    }
}
