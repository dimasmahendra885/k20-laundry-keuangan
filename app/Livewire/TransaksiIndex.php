<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaksi;

class TransaksiIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $query = Transaksi::with(['pelanggan' => function($q) {
                $q->withTrashed();
            }]);

        if ($this->search) {
            $query->where(function($q) {
                $q->whereHas('pelanggan', function($sq) {
                    $sq->withTrashed()->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhere('kode_transaksi', 'like', '%' . $this->search . '%');
            });
        }

        $transaksis = $query->latest()->paginate(10);
        $jumlahBelumLunas = Transaksi::where('status_pembayaran', 'belum_lunas')->count();

        return view('livewire.transaksi-index', [
            'transaksis' => $transaksis,
            'jumlahBelumLunas' => $jumlahBelumLunas
        ]);
    }

    public function lunasi($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->update(['status_pembayaran' => 'lunas']);
            session()->flash('message', 'Transaksi #' . $transaksi->kode_transaksi . ' telah dilunasi.');
        }
    }

    public function delete($id)
    {
        Transaksi::find($id)->delete();
        session()->flash('message', 'Transaksi Berhasil Dihapus.');
    }
}
