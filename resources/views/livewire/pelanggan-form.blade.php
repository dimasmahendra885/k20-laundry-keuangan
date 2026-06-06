<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">{{ $pelanggan_id ? 'Edit Pelanggan' : 'Pelanggan Baru' }}</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Isi informasi pelanggan dengan lengkap.</p>
        </div>
        <div class="flex items-center gap-3">
            <a wire:navigate href="{{ route('pelanggan.index') }}" class="flex items-center gap-2 px-4 py-2 border border-outline-variant text-primary rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl shadow-lg overflow-hidden">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined !text-3xl">{{ $pelanggan_id ? 'edit_square' : 'person_add' }}</span>
                </div>
                <div>
                    <h3 class="text-headline-sm font-headline-sm text-primary">Informasi Pelanggan</h3>
                    <p class="text-body-md text-on-surface-variant">Data ini akan digunakan untuk manajemen transaksi laundry.</p>
                </div>
            </div>

            <form wire:submit.prevent="store" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Nama Lengkap</label>
                    <input type="text" wire:model="nama" 
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50"
                        placeholder="Masukkan nama pelanggan">
                    @error('nama') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Nomor Handphone</label>
                    <input type="text" wire:model="nomor_hp" 
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50 font-data-mono"
                        placeholder="08xxxxxxxxxx">
                    @error('nomor_hp') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Alamat</label>
                    <textarea wire:model="alamat" rows="3"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50"
                        placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Catatan Tambahan (Opsional)</label>
                    <textarea wire:model="catatan" rows="2"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50"
                        placeholder="Misal: Langganan tetap, alergi deterjen tertentu..."></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                        class="w-full px-4 py-4 bg-secondary text-on-secondary rounded-xl font-label-md shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        {{ $pelanggan_id ? 'Simpan Perubahan' : 'Daftarkan Pelanggan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
