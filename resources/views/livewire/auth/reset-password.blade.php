<div class="w-full max-w-[400px]">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-on-secondary-container flex items-center justify-center mb-4 shadow-lg">
                    <span class="material-symbols-outlined text-white !text-4xl" style="font-variation-settings: 'FILL' 1;">lock_open</span>
                </div>
                <h1 class="text-headline-md font-display-lg text-primary text-center">Reset Password</h1>
                <p class="text-body-md text-on-surface-variant text-center">Silakan masukkan password baru Anda.</p>
            </div>

            <form wire:submit.prevent="resetPassword" class="space-y-6">
                <input type="hidden" wire:model="token">

                <div class="space-y-2">
                    <label for="email" class="text-label-md font-label-md text-on-surface-variant px-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                        <input wire:model="email" id="email" type="email" required readonly
                            class="w-full bg-surface-container/50 border-none rounded-xl py-3 pl-12 pr-4 text-body-md text-on-surface-variant/70 cursor-not-allowed"
                            placeholder="nama@k20.com">
                    </div>
                    @error('email') <span class="text-error text-[12px] px-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-label-md font-label-md text-on-surface-variant px-1">Password Baru</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                        <input wire:model="password" id="password" type="password" required autofocus
                            class="w-full bg-surface-container border-none rounded-xl py-3 pl-12 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/50"
                            placeholder="Minimal 8 karakter">
                    </div>
                    @error('password') <span class="text-error text-[12px] px-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-label-md font-label-md text-on-surface-variant px-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock_clock</span>
                        <input wire:model="password_confirmation" id="password_confirmation" type="password" required
                            class="w-full bg-surface-container border-none rounded-xl py-3 pl-12 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/50"
                            placeholder="Ulangi password baru">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-secondary text-on-secondary font-label-md py-3 rounded-xl shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span>Simpan Password Baru</span>
                    <span class="material-symbols-outlined">save</span>
                </button>
            </form>
        </div>
        <div class="bg-surface-container-low p-4 text-center border-t border-outline-variant/30">
            <p class="text-[12px] text-on-surface-variant">
                &copy; {{ date('Y') }} K20 Laundry Financial Management.
            </p>
        </div>
    </div>
</div>
