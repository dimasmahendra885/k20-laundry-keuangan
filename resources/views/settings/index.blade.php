<x-layouts.app>
    <div>
        <!-- Page Header -->
        <div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-[40px] font-bold text-primary leading-none">Pengaturan Aplikasi</h2>
                <p class="text-body-lg text-on-surface-variant mt-2">Kelola informasi toko dan pengaturan aplikasi lainnya.</p>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="mb-6 p-4 bg-secondary/10 border border-secondary/20 text-secondary rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="text-label-md font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl shadow-lg overflow-hidden">
            <div class="p-8">
                <form action="{{ route('pengaturan.update') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="text-label-md font-label-md text-on-surface-variant px-1">Nama Outlet</label>
                            <input type="text" name="nama_toko" value="{{ old('nama_toko', optional($setting)->nama_toko) }}" 
                                class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50 @error('nama_toko') border-error @enderror">
                            @error('nama_toko') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                        </div>

                        <!-- Target Section -->
                        <div class="mt-4">
                            <h3 class="text-headline-xs font-headline-xs text-primary px-1 mb-4">Pengaturan Target</h3>
                            <div class="max-w-md space-y-2">
                                <label class="text-label-md font-label-md text-on-surface-variant px-1">Target Pemasukan (Rp)</label>
                                <input type="number" name="target_harian" value="{{ old('target_harian', optional($setting)->target_harian) }}" 
                                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-3 px-4 text-body-md focus:ring-2 focus:ring-secondary/50 @error('target_harian') border-error @enderror">
                                @error('target_harian') <span class="text-error text-[11px] font-bold px-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit" 
                            class="w-full px-4 py-4 bg-secondary text-on-secondary rounded-xl font-label-md shadow-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
