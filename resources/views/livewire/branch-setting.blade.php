<div>
    <div class="mb-stack-lg">
        <h2 class="text-[40px] font-bold text-primary leading-none">Pengaturan Cabang</h2>
        <p class="text-body-lg text-on-surface-variant mt-2">Kelola target finansial untuk cabang Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-low">
                    <h3 class="text-headline-sm font-headline-sm text-primary">Target Finansial</h3>
                </div>
                
                <form wire:submit.prevent="update" class="p-6 space-y-6">
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" 
                             x-init="setTimeout(() => show = false, 3000)" 
                             x-show="show"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="p-4 bg-secondary-container text-on-secondary-container rounded-lg flex items-center gap-3">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="target_daily" class="text-label-md font-label-md text-on-surface-variant">Target Harian</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">Rp</span>
                                <input type="number" id="target_daily" wire:model="target_daily" class="w-full pl-10 pr-4 py-2 bg-surface-container border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all @error('target_daily') border-error @enderror" placeholder="0">
                            </div>
                            @error('target_daily') <span class="text-error text-[12px] font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="target_weekly" class="text-label-md font-label-md text-on-surface-variant">Target Mingguan</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">Rp</span>
                                <input type="number" id="target_weekly" wire:model="target_weekly" class="w-full pl-10 pr-4 py-2 bg-surface-container border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all @error('target_weekly') border-error @enderror" placeholder="0">
                            </div>
                            @error('target_weekly') <span class="text-error text-[12px] font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="target_monthly" class="text-label-md font-label-md text-on-surface-variant">Target Bulanan</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">Rp</span>
                                <input type="number" id="target_monthly" wire:model="target_monthly" class="w-full pl-10 pr-4 py-2 bg-surface-container border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all @error('target_monthly') border-error @enderror" placeholder="0">
                            </div>
                            @error('target_monthly') <span class="text-error text-[12px] font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <p class="text-xs text-on-surface-variant/70 italic mt-2">
                        Tips: Anda cukup mengisi salah satu target saja (misal Harian). Sistem akan otomatis menghitung target lainnya untuk Anda.
                    </p>

                    <div class="pt-4 border-t border-outline-variant flex justify-end">
                        <button type="submit" wire:loading.attr="disabled" class="flex items-center gap-2 px-6 py-2 bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-sm hover:brightness-110 active:scale-95 transition-all disabled:opacity-50">
                            <span class="material-symbols-outlined" style="font-size: 20px;" wire:loading.remove>save</span>
                            <span class="animate-spin material-symbols-outlined" style="font-size: 20px;" wire:loading>sync</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-primary-container text-on-primary p-6 rounded-xl shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <span class="material-symbols-outlined !text-6xl">info</span>
                </div>
                <h4 class="text-headline-sm font-headline-sm mb-2 relative z-10">Pusat Bantuan</h4>
                <p class="text-body-md text-on-primary-container/80 relative z-10">Target ini akan muncul di dashboard utama sebagai indikator performa cabang Anda. Pastikan angka yang dimasukkan sudah realistis.</p>
            </div>
            
            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl shadow-sm">
                <h4 class="text-label-lg font-label-lg text-primary mb-4">Tips Menetapkan Target</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">lightbulb</span>
                        <p class="text-body-md text-on-surface-variant">Gunakan rata-rata pendapatan bulan lalu sebagai patokan.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">trending_up</span>
                        <p class="text-body-md text-on-surface-variant">Tambahkan 10-15% dari rata-rata untuk target pertumbuhan.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
