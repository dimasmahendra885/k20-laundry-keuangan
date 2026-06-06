<div>
    <!-- Page Header -->
    <div class="mb-stack-lg">
        <h2 class="text-[40px] font-bold text-primary leading-none">Restock {{ $nama_detergen }}</h2>
        <p class="text-body-lg text-on-surface-variant mt-2">Catat penambahan stok deterjen dan hubungkan dengan pengeluaran jika ada.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden max-w-2xl">
        <form wire:submit.prevent="store" class="p-8 space-y-6">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Jumlah Masuk -->
                    <div>
                        <label class="block text-label-md font-label-md text-on-surface-variant mb-2">Jumlah Tambahan</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">add_circle</span>
                            <input wire:model="jumlah" type="number" step="0.01" placeholder="Masukkan jumlah..." 
                                class="w-full bg-surface-container-low border border-outline-variant rounded-xl py-3 pl-11 pr-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        </div>
                        @error('jumlah') <span class="text-error text-[12px] font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-label-md font-label-md text-on-surface-variant mb-2">Tanggal Restock</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">calendar_today</span>
                            <input wire:model="tanggal" type="date" 
                                class="w-full bg-surface-container-low border border-outline-variant rounded-xl py-3 pl-11 pr-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        </div>
                        @error('tanggal') <span class="text-error text-[11px] font-medium mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Harga Total (Optional for Pengeluaran) -->
                <div>
                    <label class="block text-label-md font-label-md text-on-surface-variant mb-2">Harga Total (Opsional)</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-surface-container-high border border-r-0 border-outline-variant rounded-l-xl text-on-surface-variant font-bold text-body-md">
                            Rp
                        </span>
                        <input wire:model="harga_total" type="number" placeholder="Jika ada, otomatis masuk ke Pengeluaran..." 
                            class="flex-1 bg-surface-container-low border border-outline-variant rounded-r-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    </div>
                    <p class="text-[11px] text-on-surface-variant mt-1 italic">* Jika diisi, sistem akan otomatis membuat catatan di menu Pengeluaran.</p>
                    @error('harga_total') <span class="text-error text-[12px] font-medium mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-label-md font-label-md text-on-surface-variant mb-2">Keterangan (Opsional)</label>
                    <textarea wire:model="keterangan" rows="3" placeholder="Misal: Beli di Toko Sinar Jaya..." 
                        class="w-full bg-surface-container-low border border-outline-variant rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"></textarea>
                    @error('keterangan') <span class="text-error text-[12px] font-medium mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t border-outline-variant/30 flex items-center justify-end gap-3">
                <a wire:navigate href="{{ route('detergen.index') }}" class="px-6 py-2.5 text-label-md font-label-md text-on-surface-variant hover:bg-surface-variant/20 rounded-xl transition-all">Batal</a>
                <button type="submit" class="flex items-center gap-2 px-8 py-2.5 bg-secondary text-on-secondary rounded-xl font-label-md text-label-md shadow-sm hover:brightness-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined" style="font-size: 20px;">inventory</span>
                    Konfirmasi Restock
                </button>
            </div>
        </form>
    </div>
</div>
