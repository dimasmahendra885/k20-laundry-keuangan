<div>
    <!-- Page Header -->
    <div class="mb-stack-lg">
        <h2 class="text-[40px] font-bold text-primary leading-none">{{ $detergen_id ? 'Edit Data Deterjen' : 'Tambah Deterjen Baru' }}</h2>
        <p class="text-body-lg text-on-surface-variant mt-2">Lengkapi informasi detail item deterjen di bawah ini.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden max-w-2xl">
        <form wire:submit.prevent="store" class="p-8 space-y-6">
            <div class="space-y-4">
                <!-- Nama Deterjen -->
                <div>
                    <label class="block text-label-md font-label-md text-on-surface-variant mb-2">Nama Deterjen</label>
                    <div class="relative">
                        <select wire:model="nama" class="w-full bg-surface-container-low border border-outline-variant rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                            <option value="">-- Pilih Bahan Baku --</option>
                            <option value="Detergent Liquid">Detergent Liquid</option>
                            <option value="Fabric Softener">Fabric Softener</option>
                            <option value="Plastic Bags Large">Plastic Bags Large</option>
                        </select>
                    </div>
                    @error('nama') <span class="text-error text-[12px] font-medium mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Satuan -->
                <div class="space-y-2">
                    <label class="block text-label-md font-label-md text-on-surface-variant px-1">Satuan</label>
                    <select wire:model="satuan" class="w-full bg-surface-container-low border border-outline-variant rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        <option value="Liter">Liter</option>
                        <option value="Ml">Ml</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                    </select>
                    @error('satuan') <span class="text-error text-[12px] font-medium mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t border-outline-variant/30 flex items-center justify-end gap-3">
                <a wire:navigate href="{{ route('detergen.index') }}" class="px-6 py-2.5 text-label-md font-label-md text-on-surface-variant hover:bg-surface-variant/20 rounded-xl transition-all">Batal</a>
                <button type="submit" class="flex items-center gap-2 px-8 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md shadow-sm hover:brightness-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined" style="font-size: 20px;">save</span>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
