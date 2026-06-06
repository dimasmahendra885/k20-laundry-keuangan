<div class="w-full max-w-[400px]">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-on-secondary-container flex items-center justify-center mb-4 shadow-lg">
                    <span class="material-symbols-outlined text-white !text-4xl" style="font-variation-settings: 'FILL' 1;">local_laundry_service</span>
                </div>
                <h1 class="text-headline-md font-display-lg text-primary text-center">K20 Laundry</h1>
                <p class="text-body-md text-on-surface-variant text-center">Selamat datang kembali, Admin.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-secondary/10 border border-secondary/20 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">check_circle</span>
                    <p class="text-body-sm text-on-surface">{{ session('status') }}</p>
                </div>
            @endif

            <form wire:submit.prevent="login" class="space-y-6">
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

                <div class="space-y-2">
                    <label for="password" class="text-label-md font-label-md text-on-surface-variant px-1">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                        <input wire:model="password" id="password" type="password" required
                            class="w-full bg-surface-container border-none rounded-xl py-3 pl-12 pr-4 text-body-md focus:ring-2 focus:ring-secondary/50 placeholder:text-on-surface-variant/50"
                            placeholder="Masukkan password">
                    </div>
                    @error('password') <span class="text-error text-[12px] px-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input wire:model="remember" type="checkbox" class="w-4 h-4 rounded border-outline-variant text-secondary focus:ring-secondary/50 cursor-pointer">
                        <span class="text-body-md text-on-surface-variant group-hover:text-primary transition-colors">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-secondary text-on-secondary font-label-md py-3 rounded-xl shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span>Masuk Ke Dashboard</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
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
