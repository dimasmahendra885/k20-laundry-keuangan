<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">Transaksi Laundry</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Kelola semua pesanan dan status cucian pelanggan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a wire:navigate href="{{ route('transaksi.create') }}" class="flex items-center gap-2 px-4 py-2 bg-secondary text-on-secondary rounded-lg font-label-md text-label-md shadow-sm hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined" style="font-size: 18px;">add_shopping_cart</span>
                Tambah Transaksi
            </a>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-secondary-container text-on-secondary-container p-4 rounded-xl mb-6 flex items-center gap-3 shadow-sm border border-secondary/20">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="font-medium text-body-md">{{ session('message') }}</p>
        </div>
    @endif

    @if($jumlahBelumLunas > 0)
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl mb-6 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined">warning</span>
                <p class="font-medium">Perhatian: Ada <strong>{{ $jumlahBelumLunas }}</strong> transaksi yang belum lunas. Mohon segera diproses.</p>
            </div>
        </div>
    @endif

    <!-- Content Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-6 border-b border-outline-variant/30 bg-surface-container-low/30">
            <div class="relative max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input wire:model.live="search" type="text" placeholder="Cari kode atau nama pelanggan..." 
                    class="w-full bg-surface-container-highest/50 border-none rounded-full py-2.5 pl-10 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/60">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-low">
                    <tr>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Tgl Masuk</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Total Bayar</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Status Bayar</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Status Cucian</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($transaksis as $t)
                    <tr class="hover:bg-surface-container-low/30 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-body-md font-data-mono font-bold text-primary">#{{ $t->kode_transaksi }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold text-[12px]">
                                    {{ $t->pelanggan ? substr($t->pelanggan->nama, 0, 1) : '?' }}
                                </div>
                                <span class="text-body-md font-medium text-primary">
                                    @if($t->pelanggan)
                                        {{ $t->pelanggan->nama }}
                                        @if($t->pelanggan->trashed())
                                            <span class="text-[10px] text-on-surface-variant/60 font-normal ml-1">(Non-Aktif)</span>
                                        @endif
                                    @else
                                        <span class="text-on-surface-variant/50 italic font-normal">Pelanggan Terhapus</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-body-md text-on-surface-variant">{{ $t->tanggal_masuk->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-body-md font-bold text-primary">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold {{ $t->status_pembayaran == 'lunas' ? 'bg-secondary-container text-on-secondary-container' : 'bg-error-container text-on-error-container' }}">
                                {{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold {{ $t->status_cucian == 'selesai' ? 'bg-secondary-container text-on-secondary-container' : ($t->status_cucian == 'proses' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-surface-variant text-on-surface-variant') }}">
                                {{ ucfirst($t->status_cucian) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if($t->status_pembayaran == 'belum_lunas')
                                    <button wire:click="lunasi({{ $t->id }})" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Lunasi">
                                        <span class="material-symbols-outlined">payments</span>
                                    </button>
                                @endif
                                <a wire:navigate href="{{ route('transaksi.edit', $t->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined">edit_square</span>
                                </a>
                                <button wire:click="delete({{ $t->id }})" onclick="confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()" 
                                    class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant italic">
                            Belum ada transaksi ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-surface-container-low/30 border-t border-outline-variant/30">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>
