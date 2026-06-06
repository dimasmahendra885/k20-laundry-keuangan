<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Detergen;

class DetergenIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $detergens = Detergen::where('nama', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.detergen-index', [
            'detergens' => $detergens
        ]);
    }

    public function delete($id)
    {
        Detergen::find($id)->delete();
        session()->flash('message', 'Data Deterjen Berhasil Dihapus.');
    }
}
