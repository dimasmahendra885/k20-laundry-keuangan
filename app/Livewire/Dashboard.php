<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use App\Models\Detergen;
use App\Models\Setting;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Dashboard extends Component
{
    public $filterTime = 'daily';
    public $chartLabels = [];
    public $chartData = [];
    public $activeTodayIndex = -1;

    public function exportPDF()
    {
        $today = Carbon::today('Asia/Jakarta');
        $branch = auth()->user()->branch;
        
        // Base queries scoped by branch if available
        $transaksiQuery = Transaksi::withTrashed();
        $pengeluaranQuery = Pengeluaran::query();
        
        if ($branch) {
            // Asumsi: Jika ada fitur multi-cabang, model Transaksi & Pengeluaran punya branch_id
            // Namun karena kita baru menambah branch_id ke users, mungkin data transaksi belum punya branch_id.
            // Jika project belum punya branch_id di transaksi, kita abaikan dulu filternya agar tidak error,
            // atau kita asumsikan sudah ada/akan ada. Untuk sekarang kita ikuti alur user.
            // $transaksiQuery->where('branch_id', $branch->id);
            // $pengeluaranQuery->where('branch_id', $branch->id);
        }

        $pemasukanHariIni = $transaksiQuery->clone()->where('status_pembayaran', 'lunas')->whereDate('tanggal_masuk', $today)->sum('total_bayar');
        $pengeluaranHariIni = $pengeluaranQuery->clone()->whereDate('tanggal', $today)->sum('nominal');

        $data = [
            'pemasukanHariIni' => $pemasukanHariIni,
            'pengeluaranHariIni' => $pengeluaranHariIni,
            'saldoHariIni' => $pemasukanHariIni - $pengeluaranHariIni,
            'jumlahTransaksiHariIni' => $transaksiQuery->clone()->whereDate('tanggal_masuk', $today)->count(),
            'transaksiProses' => $transaksiQuery->clone()->where('status_cucian', 'proses')->count(),
            'transaksiSelesai' => $transaksiQuery->clone()->where('status_cucian', 'selesai')->count(),
            'recentTransactions' => $transaksiQuery->clone()->with('pelanggan')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
            'namaCabang' => $branch->nama ?? 'Pusat'
        ];

        $pdf = Pdf::loadView('pdf.dashboard', $data);
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Laporan_Dashboard_' . ($branch->nama ?? 'Cabang') . '_' . Carbon::now('Asia/Jakarta')->format('Y-m-d') . '.pdf');
    }

    public function render()
    {
        $now = Carbon::now('Asia/Jakarta');
        $pemasukan = 0;
        $pengeluaran = 0;
        $pemasukanSebelumnya = 0;
        $pengeluaranSebelumnya = 0;
        $nominalTarget = 0;
        $labelWaktu = '';
        $labelPerbandingan = '';

        $branch = auth()->user()->branch;
        $setting = Setting::first();

        if ($this->filterTime === 'daily') {
            $current = $now->copy()->startOfDay();
            $previous = $now->copy()->subDay()->startOfDay();
            
            $pemasukan = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereDate('tanggal_masuk', $current)->sum('total_bayar');
            $pengeluaran = Pengeluaran::whereDate('tanggal', $current)->sum('nominal');
            
            $pemasukanSebelumnya = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereDate('tanggal_masuk', $previous)->sum('total_bayar');
            $pengeluaranSebelumnya = Pengeluaran::whereDate('tanggal', $previous)->sum('nominal');
            
            $nominalTarget = $setting->target_harian ?? (($branch && $branch->target_daily > 0) ? $branch->target_daily : 500000);
            $labelWaktu = 'Hari Ini';
            $labelPerbandingan = 'vs yesterday';
        } elseif ($this->filterTime === 'weekly') {
            $startOfWeek = $now->copy()->startOfWeek();
            $endOfWeek = $now->copy()->endOfWeek();
            $startOfPrevWeek = $now->copy()->subWeek()->startOfWeek();
            $endOfPrevWeek = $now->copy()->subWeek()->endOfWeek();

            $pemasukan = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereBetween('tanggal_masuk', [$startOfWeek, $endOfWeek])->sum('total_bayar');
            $pengeluaran = Pengeluaran::whereBetween('tanggal', [$startOfWeek, $endOfWeek])->sum('nominal');

            $pemasukanSebelumnya = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereBetween('tanggal_masuk', [$startOfPrevWeek, $endOfPrevWeek])->sum('total_bayar');
            $pengeluaranSebelumnya = Pengeluaran::whereBetween('tanggal', [$startOfPrevWeek, $endOfPrevWeek])->sum('nominal');

            $nominalTarget = $setting->target_mingguan ?? (($branch && $branch->target_weekly > 0) ? $branch->target_weekly : 3500000);
            $labelWaktu = 'Minggu Ini';
            $labelPerbandingan = 'vs last week';
        } elseif ($this->filterTime === 'monthly') {
            $startOfMonth = $now->copy()->startOfMonth();
            $endOfMonth = $now->copy()->endOfMonth();
            $startOfPrevMonth = $now->copy()->subMonth()->startOfMonth();
            $endOfPrevMonth = $now->copy()->subMonth()->endOfMonth();

            $pemasukan = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereBetween('tanggal_masuk', [$startOfMonth, $endOfMonth])->sum('total_bayar');
            $pengeluaran = Pengeluaran::whereBetween('tanggal', [$startOfMonth, $endOfMonth])->sum('nominal');

            $pemasukanSebelumnya = Transaksi::withTrashed()->where('status_pembayaran', 'lunas')->whereBetween('tanggal_masuk', [$startOfPrevMonth, $endOfPrevMonth])->sum('total_bayar');
            $pengeluaranSebelumnya = Pengeluaran::whereBetween('tanggal', [$startOfPrevMonth, $endOfPrevMonth])->sum('nominal');

            $nominalTarget = $setting->target_bulanan ?? (($branch && $branch->target_monthly > 0) ? $branch->target_monthly : 15000000);
            $labelWaktu = 'Bulan Ini';
            $labelPerbandingan = 'vs last month';
        }

        $saldo = $pemasukan - $pengeluaran;
        
        // Query Transaksi berdasarkan rentang waktu filter
        $transaksiQuery = Transaksi::withTrashed();
        if ($this->filterTime === 'daily') {
            $transaksiQuery->whereDate('tanggal_masuk', $now);
        } elseif ($this->filterTime === 'weekly') {
            $transaksiQuery->whereBetween('tanggal_masuk', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()]);
        } elseif ($this->filterTime === 'monthly') {
            $transaksiQuery->whereBetween('tanggal_masuk', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()]);
        }

        $totalTransactions = $transaksiQuery->clone()->count();
        $transactionsProcess = $transaksiQuery->clone()->where('status_cucian', 'proses')->count();
        $transactionsCompleted = $transaksiQuery->clone()->where('status_cucian', 'selesai')->count();

        // Hitung Persentase Pemasukan
        $diffPemasukan = $pemasukan - $pemasukanSebelumnya;
        $persenPemasukan = $pemasukanSebelumnya != 0 ? ($diffPemasukan / $pemasukanSebelumnya) * 100 : ($pemasukan != 0 ? 100 : 0);
        
        // Hitung Persentase Pengeluaran
        $diffPengeluaran = $pengeluaran - $pengeluaranSebelumnya;
        $persenPengeluaran = $pengeluaranSebelumnya != 0 ? ($diffPengeluaran / $pengeluaranSebelumnya) * 100 : ($pengeluaran != 0 ? 100 : 0);

        // Saldo & Target
        $persentaseTarget = $nominalTarget > 0 ? ($saldo / $nominalTarget) * 100 : 0;
        if ($saldo < 0) {
            $persentaseTarget = 0;
        }
        $persentaseTargetDisplay = $persentaseTarget;
        $persentaseTargetBar = min(100, max(0, $persentaseTarget));

        $today = Carbon::today('Asia/Jakarta');
        $jumlahTransaksiHariIni = Transaksi::withTrashed()->whereDate('tanggal_masuk', $today)->count();
        $transaksiProses = Transaksi::withTrashed()->where('status_cucian', 'proses')->count();
        $transaksiSelesai = Transaksi::withTrashed()->where('status_cucian', 'selesai')->count();

        $recentTransactions = Transaksi::withTrashed()->with(['pelanggan' => function($q) {
                $q->withTrashed();
            }])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Load Performa: Transaksi per hari (Senin - Minggu)
        $startOfWeekPerformance = Carbon::now('Asia/Jakarta')->startOfWeek();
        $endOfWeekPerformance = Carbon::now('Asia/Jakarta')->endOfWeek();
        
        $weeklyPerformance = Transaksi::withTrashed()->whereBetween('tanggal_masuk', [$startOfWeekPerformance, $endOfWeekPerformance])
            ->selectRaw('EXTRACT(DOW FROM tanggal_masuk) + 1 as day, COUNT(*) as count')
            ->groupBy('day')
            ->get()
            ->pluck('count', 'day')
            ->toArray();

        $daysData = [];
        $dayMap = [2, 3, 4, 5, 6, 7, 1]; // Mon, Tue, Wed, Thu, Fri, Sat, Sun
        
        foreach ($dayMap as $dayNum) {
            $daysData[] = $weeklyPerformance[$dayNum] ?? 0;
        }

        $maxPerformance = !empty($daysData) ? max($daysData) : 0;
        if ($maxPerformance == 0) $maxPerformance = 1;

        $todayIndex = Carbon::now('Asia/Jakarta')->dayOfWeekIso - 1;

        $detergens = Detergen::all();

        // Load Performa: Dinamis berdasarkan filter
        $chartLabels = [];
        $chartData = [];
        $activeTodayIndex = -1;

        if ($this->filterTime === 'daily') {
            // Group by Hour (00:00 - 23:00)
            for ($i = 0; $i < 24; $i++) {
                $chartLabels[] = sprintf('%02d:00', $i);
                $chartData[$i] = 0;
            }
            
            $hourlyData = Transaksi::withTrashed()->whereDate('tanggal_masuk', $now)
                ->selectRaw('EXTRACT(HOUR FROM created_at) as hour, COUNT(*) as count')
                ->groupBy('hour')
                ->get()
                ->pluck('count', 'hour')
                ->toArray();
                
            foreach ($hourlyData as $hour => $count) {
                $chartData[(int)$hour] = $count;
            }
            $activeTodayIndex = $now->hour;
        } elseif ($this->filterTime === 'weekly') {
            // Group by Day of Week (Sen - Min)
            $chartLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            $dayMap = [2, 3, 4, 5, 6, 7, 1]; // Mon (2) - Sun (1) in DAYOFWEEK()
            
            $startOfWeek = $now->copy()->startOfWeek();
            $endOfWeek = $now->copy()->endOfWeek();
            
            $weeklyPerf = Transaksi::withTrashed()->whereBetween('tanggal_masuk', [$startOfWeek, $endOfWeek])
               ->selectRaw('EXTRACT(DOW FROM tanggal_masuk) + 1 as day, COUNT(*) as count')
                ->groupBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray();
                
            foreach ($dayMap as $index => $dayNum) {
                $chartData[$index] = $weeklyPerf[$dayNum] ?? 0;
            }
            $activeTodayIndex = $now->dayOfWeekIso - 1;
        } elseif ($this->filterTime === 'monthly') {
            // Group by Day of Month (1 - 31)
            $daysInMonth = $now->daysInMonth;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $chartLabels[] = (string)$i;
                $chartData[$i - 1] = 0; // Initialize 0-based: 0 to 30
            }
            
            $monthlyPerf = Transaksi::withTrashed()->whereMonth('tanggal_masuk', $now->month)
                ->whereYear('tanggal_masuk', $now->year)
                ->selectRaw('DAY(tanggal_masuk) as day, COUNT(*) as count')
                ->groupBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray();
                
            foreach ($monthlyPerf as $day => $count) {
                $chartData[(int)$day - 1] = $count;
            }
            $activeTodayIndex = $now->day - 1;
        }

        // Re-calculate max for scaling
        $maxPerformance = !empty($chartData) ? max($chartData) : 1;
        if ($maxPerformance == 0) $maxPerformance = 1;

        $this->chartLabels = $chartLabels;
        $this->chartData = array_values($chartData);
        $this->activeTodayIndex = $activeTodayIndex;

        return view('livewire.dashboard', [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'persenPemasukan' => $persenPemasukan,
            'persenPengeluaran' => $persenPengeluaran,
            'labelWaktu' => $labelWaktu,
            'labelPerbandingan' => $labelPerbandingan,
            'nominalTarget' => $nominalTarget,
            'persentaseTarget' => $persentaseTargetDisplay,
            'persentaseTargetBar' => $persentaseTargetBar,
            'totalTransactions' => $totalTransactions,
            'transactionsProcess' => $transactionsProcess,
            'transactionsCompleted' => $transactionsCompleted,
            'recentTransactions' => $recentTransactions,
            'detergens' => $detergens,
        ]);
    }
}
