<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">{{ $pengeluaran_id ? 'Edit Pengeluaran' : 'Catat Pengeluaran' }}</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Detail informasi biaya operasional.</p>
        </div>
        <div class="flex items-center gap-3">
            <a wire:navigate href="{{ route('pengeluaran.index') }}" class="flex items-center gap-2 px-4 py-2 border border-outline-variant text-primary rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl shadow-lg overflow-hidden">
        <div class="p-8">
            <form wire:submit.prevent="store" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Tanggal</label>
                    <input type="date" wire:model="tanggal" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                    @error('tanggal') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Kategori</label>
                    <select wire:model="kategori" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Nominal</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-surface-container-high border border-r-0 border-outline-variant/30 rounded-l-xl text-on-surface-variant font-bold text-body-md">
                            Rp
                        </span>
                        <input type="number" wire:model="nominal" 
                            class="flex-1 bg-surface-container-low border border-outline-variant/30 rounded-r-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50 font-bold text-error" 
                            placeholder="0">
                    </div>
                    @error('nominal') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Keterangan</label>
                    <textarea wire:model="keterangan" rows="3" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50" placeholder="Detail pengeluaran..."></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                        class="w-full px-4 py-4 bg-error text-on-error rounded-xl font-label-md shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        {{ $pengeluaran_id ? 'Simpan Perubahan' : 'Catat Pengeluaran' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
