<div>
    <!-- Page Header -->
    <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-[40px] font-bold text-primary leading-none">{{ $transaksi_id ? 'Edit Transaksi' : 'Transaksi Baru' }}</h2>
            <p class="text-body-lg text-on-surface-variant mt-2">Detail informasi pesanan laundry.</p>
        </div>
        <div class="flex items-center gap-3">
            <a wire:navigate href="{{ route('transaksi.index') }}" class="flex items-center gap-2 px-4 py-2 border border-outline-variant text-primary rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl shadow-lg overflow-hidden">
        <div class="p-8">
            <form wire:submit.prevent="store" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Pelanggan</label>
                        <select wire:model="pelanggan_id" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggans as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} - {{ $p->nomor_hp }}</option>
                            @endforeach
                        </select>
                        @error('pelanggan_id') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Tanggal Masuk</label>
                        <input type="date" wire:model="tanggal_masuk" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                        @error('tanggal_masuk') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Berat (Kg)</label>
                        <input type="number" step="0.01" id="berat_kg" wire:model.live="berat_kg" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Jumlah Item</label>
                        <input type="number" wire:model="jumlah_item" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Harga Satuan</label>
                        <input type="number" id="harga_satuan" wire:model.live="harga" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                        @error('harga') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Diskon</label>
                        <input type="number" id="diskon" wire:model.live="diskon" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1 font-bold text-secondary">Total Bayar</label>
                        <input type="number" id="total_bayar" wire:model="total_bayar" readonly class="w-full bg-surface-container-highest/50 border border-secondary/20 rounded-xl py-3 px-4 text-body-md font-bold text-primary">
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Metode Pembayaran</label>
                        <select wire:model="metode_pembayaran" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Status Pembayaran</label>
                        <select wire:model="status_pembayaran" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                            <option value="belum_lunas">Belum Lunas</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-label-md font-label-md text-on-surface-variant px-1">Status Cucian</label>
                        <select wire:model="status_cucian" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50">
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-label-md font-label-md text-on-surface-variant px-1">Catatan Tambahan</label>
                    <textarea wire:model="catatan" rows="3" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                        class="w-full px-4 py-4 bg-secondary text-on-secondary rounded-xl font-label-md shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        {{ $transaksi_id ? 'Simpan Perubahan' : 'Buat Transaksi' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const calculate = () => {
            const berat = parseFloat(document.getElementById('berat_kg').value) || 0;
            const harga = parseFloat(document.getElementById('harga_satuan').value) || 0;
            const diskon = parseFloat(document.getElementById('diskon').value) || 0;
            
            const total = (berat * harga) - diskon;
            
            // Update input UI
            const totalInput = document.getElementById('total_bayar');
            totalInput.value = total;

            // Sync with Livewire property
            @this.set('total_bayar', total);
        }

        // Listen to input events
        document.getElementById('berat_kg').addEventListener('input', calculate);
        document.getElementById('harga_satuan').addEventListener('input', calculate);
        document.getElementById('diskon').addEventListener('input', calculate);
        
        // Initial calculate for edit mode
        setTimeout(calculate, 500);
    });
</script>
