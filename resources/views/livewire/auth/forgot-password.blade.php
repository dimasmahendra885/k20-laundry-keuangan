<div class="w-full max-w-[400px]">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-on-secondary-container flex items-center justify-center mb-4 shadow-lg">
                    <span class="material-symbols-outlined text-white !text-4xl" style="font-variation-settings: 'FILL' 1;">lock_reset</span>
                </div>
                <h1 class="text-headline-md font-display-lg text-primary text-center">Lupa Password</h1>
                <p class="text-body-md text-on-surface-variant text-center">Masukkan email Anda untuk menerima link reset password.</p>
            </div>

            @if ($status)
                <div class="mb-6 p-4 rounded-xl bg-secondary/10 border border-secondary/20 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">check_circle</span>
                    <p class="text-body-sm text-on-surface">{{ $status }}</p>
                </div>
            @endif

            <form wire:submit.prevent="sendResetLink" class="space-y-6">
                <div class="space-y-2">
                    <label for="email" class="text-label-md font-label-md text-on-surface-variant px-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                        <input wire:model="email" id="email" type="email" required autofocus
                            class="w-full bg-surface-container border-none rounded-xl py-3 pl-12 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/50"
                            placeholder="nama@k20.com">
                    </div>
                    @error('email') <span class="text-error text-[12px] px-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-secondary text-on-secondary font-label-md py-3 rounded-xl shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span>Kirim Link Reset</span>
                    <span class="material-symbols-outlined">send</span>
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-label-md font-label-md text-secondary hover:underline flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
        <div class="bg-surface-container-low p-4 text-center border-t border-outline-variant/30">
            <p class="text-[12px] text-on-surface-variant">
                &copy; {{ date('Y') }} K20 Laundry Financial Management.
            </p>
        </div>
    </div>
</div>
