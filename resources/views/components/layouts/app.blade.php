<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ optional(\App\Models\Setting::first())->nama_toko ?? 'K20 Laundry' }} - Financial Management</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-background text-on-background antialiased">
    <div x-data="{ sidebarOpen: false }" x-on:livewire:navigated.window="sidebarOpen = false" class="min-h-screen">
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-50 lg:hidden"
             style="display: none;"></div>

        <!-- SideNavBar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="flex flex-col h-full py-stack-md fixed left-0 top-0 overflow-y-auto bg-primary-container dark:bg-on-tertiary-fixed docked left-0 h-screen w-[260px] shadow-md dark:shadow-none z-50 custom-scrollbar transition-transform duration-300 ease-in-out">
            <div class="px-6 mb-stack-lg flex items-center justify-between gap-3">
                <a wire:navigate href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 rounded-lg bg-on-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">local_laundry_service</span>
                    </div>
                    <div>
                        <h1 class="text-headline-sm font-headline-sm text-on-primary dark:text-on-tertiary">{{ optional(\App\Models\Setting::first())->nama_toko ?? 'K20 Laundry' }}</h1>
                        <p class="text-[10px] uppercase tracking-wider text-on-primary-container opacity-70">Financial Management</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-on-primary">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-transform duration-200 active:scale-[0.98]" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md text-label-md">Dashboard</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('pelanggan.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('pelanggan.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-label-md text-label-md">Pelanggan</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('transaksi.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('transaksi.index') }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="font-label-md text-label-md">Transaksi</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('pengeluaran.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('pengeluaran.index') }}">
                    <span class="material-symbols-outlined">payments</span>
                    <span class="font-label-md text-label-md">Pengeluaran</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('detergen.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('detergen.index') }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-label-md text-label-md">Stok Aset</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('laporan.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('laporan.index') }}">
                    <span class="material-symbols-outlined">assessment</span>
                    <span class="font-label-md text-label-md">Laporan</span>
                </a>
                <a wire:navigate class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('pengaturan.*') ? 'bg-secondary text-on-secondary' : 'text-on-primary-container dark:text-on-tertiary-container hover:bg-surface-variant/10' }} rounded-lg mx-2 transition-all" href="{{ route('pengaturan.index') }}">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-label-md text-label-md">Pengaturan</span>
                </a>
            </nav>
            <div class="px-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-on-primary-container dark:text-on-tertiary-container hover:bg-error/10 hover:text-error rounded-lg mx-2 transition-all text-left">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-label-md text-label-md">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <main class="lg:ml-[260px] min-h-screen">
            <!-- TopNavBar -->
            <header class="flex justify-between lg:justify-end items-center w-full px-container-padding py-stack-sm h-16 bg-primary-container dark:bg-on-tertiary-fixed docked full-width top-0 sticky z-40 border-b border-white/10 shadow-sm dark:shadow-none">
                <!-- Mobile Menu Toggle -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-on-primary hover:bg-white/10 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <div @click="open = !open" class="flex items-center gap-3 cursor-pointer hover:bg-white/10 p-2 rounded-lg transition-all active:scale-95">
                            <div class="text-right hidden sm:block">
                                <p class="text-label-md font-label-md text-on-primary leading-tight">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-on-primary/70 leading-tight">Administrator</p>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold border border-white/20">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="material-symbols-outlined text-on-primary transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                        </div>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-surface border border-outline-variant rounded-xl shadow-lg z-50 overflow-hidden"
                             style="display: none;">
                            <div class="px-4 py-3 border-b border-outline-variant bg-surface-container-low">
                                <p class="text-label-sm text-on-surface-variant">Signed in as</p>
                                <p class="text-label-md font-medium text-secondary truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a wire:navigate href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2 text-label-md text-secondary hover:bg-secondary-container/30 transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">person</span>
                                    Profile
                                </a>
                                <a wire:navigate href="{{ route('pengaturan.index') }}" class="flex items-center gap-3 px-4 py-2 text-label-md text-secondary hover:bg-secondary-container/30 transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">settings</span>
                                    Settings
                                </a>
                            </div>
                            <div class="border-t border-outline-variant py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-label-md text-error hover:bg-error/10 transition-colors text-left">
                                        <span class="material-symbols-outlined text-[20px]">logout</span>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-container-padding max-w-[1440px] mx-auto">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
