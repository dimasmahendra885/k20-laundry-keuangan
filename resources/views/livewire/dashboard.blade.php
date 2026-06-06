<div>
    <!-- Welcome Header -->
    <div class="mb-stack-lg">
        <h2 class="text-3xl md:text-[40px] font-bold text-primary leading-none">Dashboard</h2>
        <p class="text-body-md md:text-body-lg text-on-surface-variant mt-2">Ringkasan performa dan aktivitas finansial laundry Anda.</p>
    </div>

    <!-- Bento Grid Statistic Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-stack-lg">
        <!-- Card 1: Pemasukan -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-secondary-container text-on-secondary-container rounded-lg">
                    <span class="material-symbols-outlined">trending_up</span>
                </div>
                <span class="text-[11px] font-bold {{ $persenPemasukan >= 0 ? 'text-secondary bg-secondary/10' : 'text-error bg-error/10' }} px-2 py-1 rounded">
                    {{ $persenPemasukan >= 0 ? '+' : '' }}{{ round($persenPemasukan, 1) }}% {{ $labelPerbandingan }}
                </span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant mb-1">Total Pemasukan {{ $labelWaktu }}</p>
                <h3 class="text-2xl md:text-display-lg font-display-lg text-primary">{{ $pemasukan < 0 ? '-' : '' }}Rp {{ number_format(abs($pemasukan), 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Card 2: Pengeluaran -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-error-container text-on-error-container rounded-lg">
                    <span class="material-symbols-outlined">trending_down</span>
                </div>
                <span class="text-[11px] font-bold {{ $persenPengeluaran > 0 ? 'text-error bg-error/10' : 'text-secondary bg-secondary/10' }} px-2 py-1 rounded">
                    {{ $persenPengeluaran >= 0 ? '+' : '' }}{{ round($persenPengenluaran ?? $persenPengeluaran, 1) }}% {{ $labelPerbandingan }}
                </span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant mb-1">Total Pengeluaran {{ $labelWaktu }}</p>
                <h3 class="text-2xl md:text-display-lg font-display-lg text-primary">{{ $pengeluaran < 0 ? '-' : '' }}Rp {{ number_format(abs($pengeluaran), 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Card 3: Saldo (Special Highlight) -->
        <div class="bg-primary-container text-on-primary p-4 md:p-6 rounded-xl shadow-[0_4px_12px_rgba(19,27,46,0.2)] flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <span class="material-symbols-outlined !text-7xl">account_balance_wallet</span>
            </div>
            <div class="z-10">
                <p class="text-label-md font-label-md text-on-primary-container mb-1">Saldo {{ $labelWaktu }}</p>
                <h3 class="text-2xl md:text-display-lg font-display-lg {{ $saldo < 0 ? 'text-error' : 'text-white' }}">
                    {{ $saldo < 0 ? '-' : '' }}Rp {{ number_format(abs($saldo), 0, ',', '.') }}
                </h3>
            </div>
            <div class="mt-4 flex flex-col gap-2 z-10">
                <div class="flex justify-between items-center">
                    <span class="text-[11px] font-bold text-on-primary-container/80">Target: Rp {{ number_format($nominalTarget, 0, ',', '.') }}</span>
                    <span class="text-[11px] font-bold text-secondary-fixed">{{ round($persentaseTarget, 1) }}% Tercapai</span>
                </div>
                <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-secondary-fixed h-full transition-all duration-500" style="width: {{ $persentaseTargetBar }}%"></div>
                </div>
            </div>
        </div>

        <!-- Card 4: Jumlah Transaksi -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex items-center gap-4">
            <div class="w-12 h-12 bg-surface-container-high rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-primary">receipt_long</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant">Jumlah Transaksi {{ $labelWaktu }}</p>
                <h3 class="text-xl md:text-headline-md font-headline-md text-primary">{{ $totalTransactions }} <span class="text-label-md font-normal text-on-surface-variant">Order</span></h3>
            </div>
        </div>

        <!-- Card 5: Transaksi Proses -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex items-center gap-4">
            <div class="w-12 h-12 bg-tertiary-fixed rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-tertiary-container">cyclone</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant">Transaksi Proses {{ $labelWaktu }}</p>
                <h3 class="text-xl md:text-headline-md font-headline-md text-primary">{{ $transactionsProcess }} <span class="text-label-md font-normal text-on-surface-variant">Order</span></h3>
            </div>
        </div>

        <!-- Card 6: Transaksi Selesai -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex items-center gap-4">
            <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-on-secondary-container">check_circle</span>
            </div>
            <div>
                <p class="text-label-md font-label-md text-on-surface-variant">Transaksi Selesai {{ $labelWaktu }}</p>
                <h3 class="text-xl md:text-headline-md font-headline-md text-primary">{{ $transactionsCompleted }} <span class="text-label-md font-normal text-on-surface-variant">Order</span></h3>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Section -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden">
        <div class="px-4 py-3 md:px-6 md:py-4 border-b border-outline-variant flex items-center justify-between">
            <h3 class="text-lg md:text-headline-sm font-headline-sm text-primary">Transaksi Terbaru</h3>
            <a wire:navigate class="text-secondary font-label-md text-label-md hover:underline" href="{{ route('transaksi.index') }}">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[600px] md:min-w-full">
                <thead class="bg-surface-container-low">
                    <tr>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Kode</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Pelanggan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Waktu</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Status Cucian</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Status Bayar</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-right">Total Bayar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                    @forelse($recentTransactions as $transaksi)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-4 md:px-6 py-3 md:py-4 text-body-md font-data-mono">#{{ $transaksi->id }}</td>
                            <td class="px-4 md:px-6 py-3 md:py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-xs font-bold text-primary shrink-0">
                                        {{ $transaksi->pelanggan ? substr($transaksi->pelanggan->nama, 0, 2) : '?' }}
                                    </div>
                                    <span class="text-body-md font-medium truncate max-w-[120px] md:max-w-none text-primary">
                                        @if($transaksi->pelanggan)
                                            {{ $transaksi->pelanggan->nama }}
                                            @if($transaksi->pelanggan->trashed())
                                                <span class="text-[10px] text-on-surface-variant/60 font-normal ml-1">(Non-Aktif)</span>
                                            @endif
                                        @else
                                            <span class="text-on-surface-variant/50 italic font-normal">Pelanggan Terhapus</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 py-3 md:py-4 text-body-md text-on-surface-variant">
                                {{ $transaksi->created_at->diffForHumans() }}
                            </td>
                            <td class="px-4 md:px-6 py-3 md:py-4">
                                @php
                                    $status = strtolower($transaksi->status_cucian);
                                    $statusClasses = match($status) {
                                        'proses', 'pending' => 'bg-yellow-100 text-yellow-800',
                                        'selesai', 'sukses' => 'bg-green-100 text-green-800',
                                        'batal' => 'bg-red-100 text-red-800',
                                        default => 'bg-slate-100 text-slate-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[12px] font-bold whitespace-nowrap {{ $statusClasses }}">
                                    {{ ucfirst($transaksi->status_cucian) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-3 md:py-4">
                                <span class="px-3 py-1 rounded-full text-[12px] font-bold whitespace-nowrap {{ $transaksi->status_pembayaran == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $transaksi->status_pembayaran)) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-3 md:py-4 text-right text-body-md font-semibold whitespace-nowrap">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-on-surface-variant">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Operational Insights (Bento Extension) -->
    <div class="grid grid-cols-1 gap-6 mt-6">
        <!-- Quick Inventory Check -->
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)]">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg md:text-headline-sm font-headline-sm text-primary">Peringatan Stok</h3>
                <a wire:navigate href="{{ route('detergen.index') }}" class="text-label-md font-label-md text-secondary hover:underline">Kelola Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($detergens as $item)
                    @php
                        // Logika Ambang Batas: < 50 untuk Pcs, < 5 untuk satuan lainnya
                        $threshold = (strtolower($item->satuan) == 'pcs') ? 50 : 5;
                        $isCritical = $item->stok < $threshold;
                    @endphp
                    <div class="flex items-center justify-between p-3 {{ $isCritical ? 'bg-error-container/20' : 'bg-surface-container' }} rounded-lg gap-4">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <span class="material-symbols-outlined shrink-0 {{ $isCritical ? 'text-error' : 'text-on-surface-variant' }}">inventory_2</span>
                            <div class="overflow-hidden">
                                <p class="text-body-md font-medium text-primary truncate">{{ $item->nama }}</p>
                                <p class="text-[11px] {{ $isCritical ? 'text-error' : 'text-on-surface-variant' }} font-bold uppercase truncate">
                                    {{ $isCritical ? 'Stok Kritis' : 'Stok Aman' }}: {{ (float)$item->stok == (int)$item->stok ? number_format($item->stok, 0) : number_format($item->stok, 2, ',', '.') }} {{ $item->satuan }} Tersisa
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <a wire:navigate href="{{ route('detergen.restock', $item->id) }}" class="text-label-md font-label-md {{ $isCritical ? 'text-error underline' : 'text-secondary' }}">
                                {{ $isCritical ? 'Restock' : 'Tambah' }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-on-surface-variant text-body-md">Data inventaris belum tersedia.</p>
                        <a wire:navigate href="{{ route('detergen.index') }}" class="text-secondary text-label-md font-medium underline mt-2 inline-block">Tambah Barang</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Contextual FAB -->
    <div class="fixed bottom-8 right-8 z-50 md:hidden">
        <a wire:navigate href="{{ route('transaksi.index') }}" class="w-14 h-14 bg-primary text-white rounded-full shadow-lg flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
            <span class="material-symbols-outlined !text-3xl" style="font-variation-settings: 'FILL' 1;">add</span>
        </a>
    </div>
</div>

@script
<script>
    // Chart script removed as per user request to hide "Load Performa"
</script>
@endscript
