<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">Laporan Keuangan</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Analisis performa keuangan bisnis laundry Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 border border-secondary text-secondary rounded-lg font-label-md text-label-md hover:bg-secondary/5 transition-colors">
                <span class="material-symbols-outlined" style="font-size: 18px;">print</span>
                Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] p-6 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center justify-center">
                <span class="material-symbols-outlined">filter_list</span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary">Filter Laporan</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label class="text-label-md font-label-md text-on-surface-variant px-1">Jenis Filter</label>
                <select wire:model.live="filterType" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="range">Rentang Tanggal</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label class="text-label-md font-label-md text-on-surface-variant px-1">
                    {{ $filterType == 'bulanan' ? 'Pilih Bulan/Tahun' : ($filterType == 'range' ? 'Dari Tanggal' : 'Pilih Tanggal') }}
                </label>
                <input type="{{ $filterType == 'bulanan' ? 'month' : 'date' }}" wire:model.live="startDate" 
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
            </div>

            @if($filterType == 'range')
            <div class="space-y-2">
                <label class="text-label-md font-label-md text-on-surface-variant px-1">Sampai Tanggal</label>
                <input type="date" wire:model.live="endDate" 
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
            </div>
            @endif
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl shadow-sm flex flex-col justify-between border-l-4 border-l-secondary">
            <p class="text-label-md font-label-md text-on-surface-variant mb-1">Total Pemasukan</p>
            <h3 class="text-headline-md font-display-lg text-secondary">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl shadow-sm flex flex-col justify-between border-l-4 border-l-orange-500">
            <p class="text-label-md font-label-md text-on-surface-variant mb-1">Total Piutang</p>
            <h3 class="text-headline-md font-display-lg text-orange-600">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl shadow-sm flex flex-col justify-between border-l-4 border-l-error">
            <p class="text-label-md font-label-md text-on-surface-variant mb-1">Total Pengeluaran</p>
            <h3 class="text-headline-md font-display-lg text-error">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-primary-container text-on-primary p-6 rounded-2xl shadow-lg flex flex-col justify-between relative overflow-hidden">
            <div class="z-10">
                <p class="text-label-md font-label-md text-on-primary-container mb-1">Laba Bersih</p>
                <h3 class="text-headline-md font-display-lg text-white">Rp {{ number_format($labaBersih, 0, ',', '.') }}</h3>
            </div>
            <div class="absolute right-0 bottom-0 opacity-10 p-4">
                <span class="material-symbols-outlined !text-5xl">payments</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Daftar Transaksi -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant/30 bg-surface-container-low/30">
                <h3 class="text-headline-sm font-headline-sm text-primary">Daftar Transaksi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($transaksis as $t)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-6 py-4 text-body-md text-on-surface-variant">{{ $t->tanggal_masuk->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-body-md font-data-mono font-bold text-primary">#{{ $t->kode_transaksi }}</td>
                            <td class="px-6 py-4 text-body-md font-medium text-primary">
                                @if($t->pelanggan)
                                    {{ $t->pelanggan->nama }}
                                    @if($t->pelanggan->trashed())
                                        <span class="text-[10px] text-on-surface-variant/60 font-normal ml-1">(Non-Aktif)</span>
                                    @endif
                                @else
                                    <span class="text-on-surface-variant/50 italic font-normal">Pelanggan Terhapus</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $t->status_pembayaran == 'lunas' ? 'bg-secondary-container text-on-secondary-container' : 'bg-error-container text-on-error-container' }}">
                                    {{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-body-md font-bold text-primary">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant italic">Tidak ada data transaksi pada periode ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar Pengeluaran -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant/30 bg-surface-container-low/30">
                <h3 class="text-headline-sm font-headline-sm text-primary">Daftar Pengeluaran</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($pengeluarans as $p)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-6 py-4 text-body-md text-on-surface-variant">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-surface-variant text-on-surface-variant">{{ $p->kategori }}</span>
                            </td>
                            <td class="px-6 py-4 text-body-md text-on-surface-variant line-clamp-1">{{ $p->keterangan }}</td>
                            <td class="px-6 py-4 text-right text-body-md font-bold text-error">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant italic">Tidak ada data pengeluaran pada periode ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
