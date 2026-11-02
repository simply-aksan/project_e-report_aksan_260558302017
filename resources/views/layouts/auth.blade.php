<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#059669">
        <title>{{ $title ?? 'Autentikasi' }} · E-Report Layanan Aspirasi Warga</title>
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
    <body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-emerald-500 selection:text-white">
        <div class="grid min-h-screen lg:grid-cols-[1.15fr_1fr]">
            {{-- Visual Showcase Column (Left on Desktop) --}}
            <aside class="relative hidden overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 p-12 text-white lg:flex lg:flex-col lg:justify-between xl:p-16">
                {{-- Decorative Glow Circles --}}
                <div class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-emerald-500/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-teal-500/20 blur-3xl"></div>

                {{-- Brand Logo --}}
                <div class="relative z-10">
                    <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-3 font-display text-xl font-extrabold tracking-tight text-white group">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-lg shadow-emerald-500/30 transition group-hover:scale-105">
                            <i data-lucide="shield-check" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                        </span>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold leading-tight">
                                E-Report<span class="text-emerald-400">.</span>
                            </span>
                            <span class="text-xs font-normal text-slate-400">Portal Pengaduan Digital</span>
                        </div>
                    </a>
                </div>

                {{-- Center Content & Mock Status Card --}}
                <div class="relative z-10 max-w-lg py-12">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-950/60 px-4 py-1.5 text-xs font-semibold text-emerald-300 backdrop-blur-md">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                        </span>
                        <span>Ruang Kolaborasi Warga & Pemerintah</span>
                    </div>

                    <h1 class="font-display text-4xl leading-tight font-extrabold tracking-tight xl:text-5xl">
                        Kawal Perubahan,
                        <br>
                        <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300 bg-clip-text text-transparent">Mulai dari Suara Anda.</span>
                    </h1>
                    <p class="mt-5 text-base leading-relaxed text-slate-300">
                        Laporkan permasalahan fasilitas umum, kebersihan, dan ketertiban lingkungan dengan proses verifikasi terbuka dan pelacakan transparan hingga tuntas.
                    </p>

                    {{-- Mock Complaint Floating Card --}}
                    <div class="mt-10 rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl shadow-2xl">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold tracking-wider text-emerald-400 uppercase">Status Terkini Laporan</span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-300 border border-emerald-500/30">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Selesai Ditangani
                            </span>
                        </div>
                        <p class="mt-3 font-display font-semibold text-white">#00142 · Perbaikan Lampu Penerangan Jalan Utama</p>
                        <div class="mt-4 flex items-center justify-between text-xs text-slate-400">
                            <span>Warga RT 03/RW 05</span>
                            <span class="text-emerald-400 font-medium">Ditindaklanjuti Tim Reaksi Cepat</span>
                        </div>
                        <div class="mt-3 h-1.5 w-full rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-400 w-full"></div>
                        </div>
                    </div>

                    {{-- Key Benefits List --}}
                    <div class="mt-8 grid grid-cols-2 gap-4 text-xs text-slate-300">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="h-4 w-4 text-emerald-400 shrink-0"></i>
                            <span>Aman & Terenkripsi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="h-4 w-4 text-emerald-400 shrink-0"></i>
                            <span>Tracking Real-Time</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="h-4 w-4 text-emerald-400 shrink-0"></i>
                            <span>Bukti Foto Akurat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="h-4 w-4 text-emerald-400 shrink-0"></i>
                            <span>Layanan Bebas Biaya</span>
                        </div>
                    </div>
                </div>

                {{-- Bottom Caption --}}
                <div class="relative z-10 text-xs text-slate-500">
                    E-Report Platform · Tugas Akhir Mahasiswa TRPL Politeknik IDN
                </div>
            </aside>

            {{-- Form Column (Right) --}}
            <main class="flex items-center justify-center px-6 py-10 sm:px-12 bg-white">
                <div class="w-full max-w-md">
                    {{-- Mobile Brand Logo --}}
                    <div class="mb-8 flex items-center justify-between lg:hidden">
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2.5 font-display text-lg font-extrabold tracking-tight text-slate-900">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-md">
                                <i data-lucide="shield-check" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                            </span>
                            <span>E-Report<span class="text-emerald-600">.</span></span>
                        </a>
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-600">
                            <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
                            Beranda
                        </a>
                    </div>

                    {{-- Back Link for Desktop --}}
                    <div class="hidden lg:block mb-8">
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 transition hover:text-emerald-600">
                            <i data-lucide="arrow-left" aria-hidden="true" class="h-3.5 w-3.5 shrink-0"></i>
                            Kembali ke Halaman Utama
                        </a>
                    </div>

                    {{-- Livewire Auth Form Slot --}}
                    {{ $slot }}

                    <div class="mt-10 border-t border-slate-100 pt-6 text-center text-xs text-slate-400">
                        <p>© {{ date('Y') }} E-Report. Suara Warga, Langkah Perubahan.</p>
                    </div>
                </div>
            </main>
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
