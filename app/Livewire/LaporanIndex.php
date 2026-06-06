<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class LaporanIndex extends Component
{
    public $filterType = 'harian';
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now('Asia/Jakarta')->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    }

    public function render()
    {
        $queryTransaksi = Transaksi::withTrashed()->with(['pelanggan' => function($q) {
            $q->withTrashed();
        }]);
        $queryPengeluaran = Pengeluaran::query();

        // Gunakan tanggal default jika kosong
        $start = $this->startDate ?: Carbon::now('Asia/Jakarta')->startOfMonth()->format('Y-m-d');
        $end = $this->endDate ?: Carbon::now('Asia/Jakarta')->format('Y-m-d');

        if ($this->filterType == 'harian') {
            $queryTransaksi->whereDate('tanggal_masuk', $start);
            $queryPengeluaran->whereDate('tanggal', $start);
        } elseif ($this->filterType == 'bulanan') {
            $month = date('m', strtotime($start));
            $year = date('Y', strtotime($start));
            $queryTransaksi->whereMonth('tanggal_masuk', $month)->whereYear('tanggal_masuk', $year);
            $queryPengeluaran->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        } elseif ($this->filterType == 'range') {
            $queryTransaksi->whereBetween('tanggal_masuk', [$start, $end]);
            $queryPengeluaran->whereBetween('tanggal', [$start, $end]);
        }

        $transaksis = $queryTransaksi->get();
        $pengeluarans = $queryPengeluaran->get();

        $totalPemasukan = $transaksis->where('status_pembayaran', 'lunas')->sum('total_bayar');
        $totalPiutang = $transaksis->where('status_pembayaran', 'belum_lunas')->sum('total_bayar');
        $totalPengeluaran = $pengeluarans->sum('nominal');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        return view('livewire.laporan-index', [
            'transaksis' => $transaksis,
            'pengeluarans' => $pengeluarans,
            'totalPemasukan' => $totalPemasukan,
            'totalPiutang' => $totalPiutang,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih,
        ]);
    }
}
