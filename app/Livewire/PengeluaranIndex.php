<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengeluaran;

class PengeluaranIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $pengeluarans = Pengeluaran::where('kategori', 'like', '%' . $this->search . '%')
            ->orWhere('keterangan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.pengeluaran-index', [
            'pengeluarans' => $pengeluarans
        ]);
    }

    public function delete($id)
    {
        Pengeluaran::find($id)->delete();
        session()->flash('message', 'Data Pengeluaran Berhasil Dihapus.');
    }
}
