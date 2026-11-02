<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#059669">
        <title>{{ $title ?? 'Dashboard' }} · E-Report Layanan Aspirasi Warga</title>
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'DM Sans', sans-serif;
                --font-display: 'Plus Jakarta Sans', sans-serif;
            }

            @layer base {
                button, a, input, textarea, select {
                    @apply focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600;
                }

                button:not(:disabled), select {
                    @apply cursor-pointer;
                }

                button:disabled {
                    @apply cursor-wait opacity-60;
                }
            }
        </style>
        <style>[x-cloak] { display: none !important; }</style>
        @livewireStyles
    </head>
    <body class="bg-slate-50/80 font-sans text-slate-800 antialiased selection:bg-emerald-500 selection:text-white" x-data="{ menuOpen: false, desktop: window.innerWidth >= 1024 }" @resize.window="desktop = window.innerWidth >= 1024" @keydown.escape.window="menuOpen = false">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:rounded-xl focus:bg-emerald-700 focus:px-4 focus:py-2.5 focus:text-white focus:shadow-lg">Langsung ke konten</a>

        {{-- Mobile backdrop --}}
        <div x-show="menuOpen" x-cloak @click="menuOpen = false" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-xs transition-opacity lg:hidden"></div>

        {{-- Sidebar navigasi baru yang modern --}}
        <aside :inert="!menuOpen && !desktop" :class="menuOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-200/90 bg-white transition-transform duration-200 ease-in-out lg:translate-x-0">
            {{-- Brand Header --}}
            <div class="flex h-20 shrink-0 items-center justify-between border-b border-slate-100 px-6">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-3 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-700 via-emerald-600 to-teal-500 text-white shadow-md shadow-emerald-500/20 transition group-hover:scale-105">
                        <i data-lucide="shield-check" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <div class="flex flex-col">
                        <span class="flex items-center text-lg leading-none font-bold text-slate-900">
                            E-Report<span class="text-emerald-600">.</span>
                        </span>
                        <span class="mt-1 text-[11px] font-medium tracking-wide text-slate-400">Layanan Aspirasi</span>
                    </div>
                </a>
                <button @click="menuOpen = false" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 lg:hidden" aria-label="Tutup navigasi">
                    <i data-lucide="x" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </button>
            </div>

            {{-- Navigation Items --}}
            <div class="flex-1 overflow-y-auto px-4 py-6">
                <div class="mb-3 px-3">
                    <p class="text-[10px] font-extrabold tracking-[0.2em] text-slate-400 uppercase">
                        {{ auth()->user()->role === 'admin' ? 'PANEL ADMINISTRATOR' : 'LAYANAN WARGA' }}
                    </p>
                </div>
                <nav aria-label="Navigasi utama" class="space-y-1.5">
                    @if(auth()->user()->role === 'admin')
                        <a
                            href="{{ route('admin.dashboard') }}"
                            aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('admin.dashboard'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('admin.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-dashboard" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('admin.dashboard'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('admin.dashboard')])></i>
                            <span>Dashboard Utama</span>
                        </a>
                        <a
                            href="{{ route('admin.laporan.index') }}"
                            aria-current="{{ request()->routeIs('admin.laporan.*') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('admin.laporan.*'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('admin.laporan.*'),
                            ])
                        >
                            <i data-lucide="file-text" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('admin.laporan.*'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('admin.laporan.*')])></i>
                            <span>Semua Pengaduan</span>
                        </a>
                    @else
                        <a
                            href="{{ route('warga.dashboard') }}"
                            aria-current="{{ request()->routeIs('warga.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('warga.dashboard'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('warga.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-grid" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('warga.dashboard'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('warga.dashboard')])></i>
                            <span>Dashboard</span>
                        </a>
                        <a
                            href="{{ route('warga.laporan.index') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                            ])
                        >
                            <i data-lucide="inbox" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit')])></i>
                            <span>Pengaduan Saya</span>
                        </a>
                        <a
                            href="{{ route('warga.laporan.create') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.create') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('warga.laporan.create'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('warga.laporan.create'),
                            ])
                        >
                            <i data-lucide="plus-circle" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('warga.laporan.create'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('warga.laporan.create')])></i>
                            <span>Buat Pengaduan</span>
                        </a>

                        <div class="pt-5 pb-2 px-3">
                            <p class="text-[10px] font-extrabold tracking-[0.2em] text-slate-400 uppercase">AKUN PENGGUNA</p>
                        </div>

                        <a
                            href="{{ route('warga.profile') }}"
                            aria-current="{{ request()->routeIs('warga.profile') ? 'page' : 'false' }}"
                            @class([
                                'group flex items-center gap-3.5 rounded-xl px-3.5 py-3 text-sm font-semibold transition-all duration-150',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' => request()->routeIs('warga.profile'),
                                'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' => ! request()->routeIs('warga.profile'),
                            ])
                        >
                            <i data-lucide="user" aria-hidden="true" @class(['h-5 w-5 shrink-0 transition', 'text-white' => request()->routeIs('warga.profile'), 'text-slate-400 group-hover:text-emerald-600' => !request()->routeIs('warga.profile')])></i>
                            <span>Profil Saya</span>
                        </a>
                    @endif
                </nav>
            </div>

            {{-- Bottom Civic Badge & Info Card --}}
            <div class="px-4 pb-3">
                <div class="rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50/70 to-teal-50/50 p-4">
                    <div class="flex items-center gap-2.5">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                        </span>
                        <p class="text-xs font-bold text-emerald-900">Sistem Pengaduan Aktif</p>
                    </div>
                    <p class="mt-1 text-[11px] leading-relaxed text-emerald-700">Setiap aspirasi Anda diproses secara transparan dan akuntabel.</p>
                </div>
            </div>

            {{-- Logout Action --}}
            <div class="border-t border-slate-100 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-rose-50 hover:text-rose-600">
                        <i data-lucide="log-out" aria-hidden="true" class="h-4.5 w-4.5 shrink-0"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Content Area --}}
        <div class="lg:pl-72">
            {{-- Top Header --}}
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between gap-4 border-b border-slate-200/80 bg-white/80 px-5 backdrop-blur-md sm:px-8">
                <div class="flex items-center gap-4">
                    <button @click="menuOpen = true" aria-label="Buka navigasi" :aria-expanded="menuOpen" class="rounded-xl border border-slate-200 p-2 text-slate-600 hover:bg-slate-50 lg:hidden">
                        <i data-lucide="menu" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                    </button>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-display text-base font-bold text-slate-900 sm:text-lg">{{ $title ?? 'Dashboard' }}</h2>
                            <span class="hidden rounded-md bg-emerald-50 px-2 py-0.5 text-[11px] font-bold text-emerald-700 sm:inline-block">E-Report</span>
                        </div>
                        <p class="mt-0.5 hidden text-xs text-slate-500 sm:block">Sistem Layanan Aspirasi dan Penanganan Pengaduan Lingkungan</p>
                    </div>
                </div>

                {{-- User Profile Pill & Date --}}
                <div class="flex items-center gap-3">
                    <div class="hidden items-center gap-2 rounded-xl border border-slate-200/80 bg-slate-50/80 px-3.5 py-2 text-xs font-medium text-slate-600 md:inline-flex">
                        <i data-lucide="calendar" aria-hidden="true" class="h-3.5 w-3.5 text-emerald-600"></i>
                        <span>{{ now()->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200/90 bg-white p-1.5 pr-3 shadow-xs">
                        @if(auth()->user()->foto)
                            <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil" class="h-9 w-9 rounded-xl object-cover ring-2 ring-emerald-500/20">
                        @else
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-sm font-extrabold text-white shadow-xs">
                                {{ mb_substr(auth()->user()->name, 0, 1) }}
                            </span>
                        @endif
                        <div class="hidden text-left sm:block">
                            <p class="max-w-[140px] truncate text-xs font-bold text-slate-900 leading-tight">{{ auth()->user()->name }}</p>
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold tracking-wide uppercase {{ auth()->user()->role === 'admin' ? 'text-amber-600' : 'text-emerald-600' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ auth()->user()->role === 'admin' ? 'bg-amber-500' : 'bg-emerald-500' }}"></span>
                                {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Warga' }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main id="main-content" class="mx-auto min-h-[calc(100vh-140px)] max-w-7xl px-4 py-6 sm:px-8 sm:py-8">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="flex flex-col gap-2 border-t border-slate-200/80 bg-white/50 px-5 py-5 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                <p>© {{ date('Y') }} E-Report — Sistem Layanan Aspirasi Warga. Dikelola untuk transparansi publik.</p>
                <p class="font-medium text-slate-500">TRPL Politeknik IDN · Suara Warga, Langkah Perubahan</p>
            </footer>
        </div>

        @livewireScripts
        <script src="{{ asset('assets/lucide.min.js') }}"></script>
        <script>
            function renderIcons() {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }

            renderIcons();
            document.addEventListener('livewire:navigated', renderIcons);
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morphed', renderIcons);
            });
        </script>
    </body>
</html>
