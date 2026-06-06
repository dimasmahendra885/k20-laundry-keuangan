<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">Manajemen Deterjen</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Pantau stok dan kelola inventaris deterjen laundry Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <a wire:navigate href="{{ route('detergen.create') }}" class="flex items-center gap-2 px-4 py-2 bg-secondary text-on-secondary rounded-lg font-label-md text-label-md shadow-sm hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined" style="font-size: 18px;">add_box</span>
                Tambah Item
            </a>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-secondary-container text-on-secondary-container p-4 rounded-xl mb-6 flex items-center gap-3 shadow-sm border border-secondary/20">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="font-medium text-body-md">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Content Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-6 border-b border-outline-variant/30 bg-surface-container-low/30">
            <div class="relative max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input wire:model.live="search" type="text" placeholder="Cari nama deterjen..." 
                    class="w-full bg-surface-container-highest/50 border-none rounded-full py-2.5 pl-10 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/60">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-low">
                    <tr>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Nama Deterjen</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-center">Stok Tersedia</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Satuan</th>
                        <th class="px-6 py-4 text-label-md font-label-md text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($detergens as $d)
                    <tr class="hover:bg-surface-container-low/30 transition-colors group">
                        <td class="px-6 py-4">
                            <p class="text-body-md font-semibold text-primary">{{ $d->nama }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1.5 rounded-full {{ $d->stok <= 5 ? 'bg-error-container text-on-error-container' : 'bg-success-container text-on-success-container' }} font-bold text-body-md">
                                {{ $d->stok }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-body-md text-on-surface-variant">{{ $d->satuan }}</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a wire:navigate href="{{ route('detergen.restock', $d->id) }}" class="flex items-center gap-1 px-3 py-1.5 bg-primary text-on-primary rounded-lg text-label-sm hover:brightness-110 transition-all" title="Restock">
                                    <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                                    Restock
                                </a>
                                <a wire:navigate href="{{ route('detergen.edit', $d->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined">edit_square</span>
                                </a>
                                <button wire:click="delete({{ $d->id }})" onclick="confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()" 
                                    class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 opacity-40">
                                <span class="material-symbols-outlined !text-5xl">inventory</span>
                                <p class="text-body-lg font-medium">Data deterjen tidak ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-surface-container-low/30 border-t border-outline-variant/30">
            {{ $detergens->links() }}
        </div>
    </div>
</div>
