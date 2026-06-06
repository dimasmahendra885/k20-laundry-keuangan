<div>
    <div class="mb-stack-lg">
        <h2 class="text-[40px] font-bold text-primary leading-none">Profile</h2>
        <p class="text-body-lg text-on-surface-variant mt-2">Kelola informasi profil dan keamanan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)]">
                <div class="flex flex-col items-center text-center">
                    <div class="w-24 h-24 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-4xl font-bold border-4 border-surface-container-high mb-4">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <h3 class="text-headline-sm font-headline-sm text-primary">{{ auth()->user()->name }}</h3>
                    <p class="text-label-md text-on-surface-variant">{{ auth()->user()->email }}</p>
                    <div class="mt-4 px-4 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[12px] font-bold uppercase tracking-wider">
                        Administrator
                    </div>
                </div>
                
                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                        <div class="text-left">
                            <p class="text-[11px] uppercase tracking-wider opacity-70">Terdaftar Sejak</p>
                            <p class="text-label-md font-medium text-on-surface">{{ auth()->user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">location_on</span>
                        <div class="text-left">
                            <p class="text-[11px] uppercase tracking-wider opacity-70">Cabang</p>
                            <p class="text-label-md font-medium text-on-surface">{{ auth()->user()->branch->nama ?? 'Semua Cabang' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="lg:col-span-2">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-low">
                    <h3 class="text-headline-xs font-headline-xs text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">lock</span>
                        Ubah Password
                    </h3>
                </div>
                
                <div class="p-6">
                    @if (session()->has('success'))
                        <div class="mb-6 p-4 bg-secondary/10 border border-secondary/20 text-secondary rounded-lg flex items-center gap-3">
                            <span class="material-symbols-outlined">check_circle</span>
                            <p class="text-label-md font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form wire:submit.prevent="updatePassword" class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-label-md font-label-md text-on-surface mb-2">Password Saat Ini</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock_open</span>
                                <input type="password" wire:model="current_password" id="current_password" 
                                    class="w-full pl-10 pr-4 py-2 bg-surface border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all @error('current_password') border-error @enderror" 
                                    placeholder="Masukkan password saat ini">
                            </div>
                            @error('current_password') <span class="text-error text-[12px] mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-label-md font-label-md text-on-surface mb-2">Password Baru</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                                <input type="password" wire:model="new_password" id="new_password" 
                                    class="w-full pl-10 pr-4 py-2 bg-surface border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all @error('new_password') border-error @enderror" 
                                    placeholder="Minimal 8 karakter">
                            </div>
                            @error('new_password') <span class="text-error text-[12px] mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-label-md font-label-md text-on-surface mb-2">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock_reset</span>
                                <input type="password" wire:model="new_password_confirmation" id="new_password_confirmation" 
                                    class="w-full pl-10 pr-4 py-2 bg-surface border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" 
                                    placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" wire:loading.attr="disabled" class="flex items-center gap-2 px-6 py-2 bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-md hover:brightness-110 active:scale-95 transition-all disabled:opacity-70">
                                <span wire:loading.remove wire:target="updatePassword">Simpan Perubahan</span>
                                <span wire:loading wire:target="updatePassword">Memproses...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
