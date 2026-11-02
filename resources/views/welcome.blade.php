<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#059669">
        <title>E-Report · Portal Layanan Pengaduan & Aspirasi Warga</title>
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
        <meta name="description" content="E-Report adalah sistem informasi pengaduan masyarakat yang transparan, akuntabel, dan real-time untuk memfasilitasi pelaporan keluhan lingkungan warga.">
    </head>
    <body class="bg-white font-sans text-slate-900 antialiased selection:bg-emerald-500 selection:text-white">
        {{-- Top Notification Bar --}}
        <div class="bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 px-4 py-2 text-center text-xs text-emerald-200">
            <span class="inline-flex items-center gap-2">
                <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Layanan E-Report Siap Melayani Warga 24 Jam — Suara Anda, Langkah Perubahan.</span>
            </span>
        </div>

        {{-- Navigation Header --}}
        <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
            <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4 lg:px-10" aria-label="Navigasi beranda">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-3 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-md shadow-emerald-500/20 transition group-hover:scale-105">
                        <i data-lucide="shield-check" aria-hidden="true" class="h-6 w-6 shrink-0"></i>
                    </span>
                    <div class="flex flex-col">
                        <span class="flex items-center text-lg leading-tight font-extrabold text-slate-900">
                            E-Report<span class="text-emerald-600">.</span>
                        </span>
                        <span class="text-[10px] font-medium tracking-wide text-slate-400 uppercase">Aspirasi Warga</span>
                    </div>
                </a>

                <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                    <a href="#tentang" class="transition hover:text-emerald-600">Tentang</a>
                    <a href="#cara-kerja" class="transition hover:text-emerald-600">Alur Pelaporan</a>
                    <a href="#status" class="transition hover:text-emerald-600">Tahapan Status</a>
                    <a href="#faq" class="transition hover:text-emerald-600">FAQ</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a
                            href="{{ route(auth()->user()->dashboardRoute()) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-600/30 transition hover:bg-emerald-700"
                        >
                            <span>Buka Dashboard</span>
                            <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-bold text-slate-700 hover:text-emerald-600 transition">
                            Masuk
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-600/30 transition hover:bg-emerald-700"
                        >
                            <span>Daftar Akun</span>
                            <i data-lucide="user-plus" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main>
            {{-- Hero Section --}}
            <section class="relative overflow-hidden bg-gradient-to-b from-emerald-50/40 via-white to-white py-16 lg:py-24">
                {{-- Ambient Background Glow --}}
                <div class="pointer-events-none absolute top-0 left-1/2 -translate-x-1/2 h-[500px] w-full max-w-6xl bg-radial-glow blur-2xl"></div>

                <div class="relative mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
                        <div>
                            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50/90 px-4 py-1.5 text-xs font-bold text-emerald-800 shadow-xs">
                                <span class="relative flex h-2 w-2">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-600"></span>
                                </span>
                                <span>PORTAL RESMI PENGADUAN & LAYANAN ASPIRASI WARGA</span>
                            </div>

                            <h1 class="font-display text-4xl leading-[1.15] font-extrabold tracking-tight text-slate-950 sm:text-6xl">
                                Suara Anda,
                                <br>
                                <span class="bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 bg-clip-text text-transparent">Langkah Nyata</span>
                                Perubahan Lingkungan.
                            </h1>

                            <p class="mt-6 max-w-xl text-base leading-relaxed text-slate-600 sm:text-lg">
                                Sampaikan keluhan jalan rusak, fasilitas umum tidak berfungsi, sampah menumpuk, atau penerangan padam secara mudah, cepat, dan transparan melalui platform E-Report.
                            </p>

                            <div class="mt-8 flex flex-wrap items-center gap-4">
                                <a
                                    href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                                    class="group inline-flex items-center justify-center gap-2.5 rounded-xl bg-emerald-600 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 transition hover:bg-emerald-700 active:scale-[0.99]"
                                >
                                    <span>Mulai Buat Pengaduan</span>
                                    <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1"></i>
                                </a>

                                <a
                                    href="#cara-kerja"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-4 text-sm font-bold text-slate-700 transition hover:bg-slate-50 hover:text-emerald-700"
                                >
                                    <i data-lucide="help-circle" class="h-4 w-4 text-slate-400"></i>
                                    <span>Pelajari Alur Kerja</span>
                                </a>
                            </div>

                            {{-- Trust Badge Highlights --}}
                            <div class="mt-12 flex flex-wrap items-center gap-6 border-t border-slate-200/80 pt-8 text-xs text-slate-500">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-emerald-600 shrink-0"></i>
                                    <span>100% Bebas Biaya</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-emerald-600 shrink-0"></i>
                                    <span>Privasi Terlindungi</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-emerald-600 shrink-0"></i>
                                    <span>Respon Cepat Petugas</span>
                                </div>
                            </div>
                        </div>

                        {{-- Hero Interactive Mockup --}}
                        <div class="relative">
                            <div class="relative mx-auto w-full max-w-lg rounded-3xl border border-slate-200/90 bg-white p-6 shadow-2xl shadow-slate-200/60">
                                {{-- Card Header --}}
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                            <i data-lucide="bell" class="h-4 w-4"></i>
                                        </span>
                                        <div>
                                            <p class="text-xs font-bold text-slate-900">Penanganan Pengaduan</p>
                                            <p class="text-[10px] text-slate-400">Pembaruan Progres Realtime</p>
                                        </div>
                                    </div>
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700">
                                        Aktif
                                    </span>
                                </div>

                                {{-- Sample Case 1 --}}
                                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-extrabold tracking-wider text-slate-400">#00214 · FASILITAS UMUM</span>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[10px] font-bold text-emerald-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai Ditangani
                                        </span>
                                    </div>
                                    <h4 class="mt-2 text-sm font-bold text-slate-800">Perbaikan Lampu Penerangan Jalan RT 04</h4>
                                    <p class="mt-1 text-xs text-slate-500 line-clamp-2">Lampu jalan padam telah diganti oleh petugas dinas penerangan setempat dan berfungsi normal.</p>
                                    <div class="mt-3 flex items-center justify-between text-[11px] text-slate-400">
                                        <span>Tanggal Selesai: Hari ini</span>
                                        <span class="font-semibold text-emerald-600">Terverifikasi</span>
                                    </div>
                                </div>

                                {{-- Sample Case 2 --}}
                                <div class="mt-3 rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-extrabold tracking-wider text-slate-400">#00215 · KEBERSIHAN</span>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-sky-100 px-2.5 py-0.5 text-[10px] font-bold text-sky-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                            Sedang Diproses
                                        </span>
                                    </div>
                                    <h4 class="mt-2 text-sm font-bold text-slate-800">Pengangkutan Sampah Liar di Saluran Air</h4>
                                    <p class="mt-1 text-xs text-slate-500 line-clamp-2">Laporan telah diverifikasi oleh pengelola. Tim kebersihan telah dijadwalkan turun ke lokasi.</p>
                                </div>

                                {{-- Live Status Indicator --}}
                                <div class="mt-4 flex items-center justify-between rounded-xl bg-emerald-900 p-3.5 text-white">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="shield" class="h-4 w-4 text-emerald-400"></i>
                                        <span class="text-xs font-semibold">Tersinkronisasi Otomatis</span>
                                    </div>
                                    <span class="text-[10px] font-medium text-emerald-300">Live Server</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Stat Numbers Band --}}
            <section class="border-y border-slate-100 bg-slate-900 text-white py-12">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="grid grid-cols-2 gap-8 text-center md:grid-cols-4">
                        <div>
                            <p class="font-display text-3xl font-extrabold text-emerald-400 sm:text-4xl">100%</p>
                            <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-wider">Akses Terbuka</p>
                        </div>
                        <div>
                            <p class="font-display text-3xl font-extrabold text-emerald-400 sm:text-4xl">3 Tahap</p>
                            <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-wider">Alur Terstruktur</p>
                        </div>
                        <div>
                            <p class="font-display text-3xl font-extrabold text-emerald-400 sm:text-4xl">Realtime</p>
                            <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-wider">Pelacakan Status</p>
                        </div>
                        <div>
                            <p class="font-display text-3xl font-extrabold text-emerald-400 sm:text-4xl">24 / 7</p>
                            <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-wider">Layanan Tersedia</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Section: Tentang E-Report --}}
            <section id="tentang" class="py-20 lg:py-28">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="mx-auto max-w-2xl text-center">
                        <span class="inline-block rounded-full bg-emerald-50 px-3.5 py-1 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                            TENTANG E-REPORT
                        </span>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Mengapa Menggunakan E-Report?
                        </h2>
                        <p class="mt-4 text-base text-slate-500 leading-relaxed">
                            Kami menghadirkan solusi teknologi untuk menjembatani komunikasi antara warga dan pengelola lingkungan secara transparan, mudah, dan terdokumentasi.
                        </p>
                    </div>

                    <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200/90 bg-white p-8 transition duration-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-100">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                                <i data-lucide="file-check" class="h-6 w-6"></i>
                            </span>
                            <h3 class="mt-6 font-display text-lg font-bold text-slate-900">Bukti Foto & Validasi</h3>
                            <p class="mt-3 text-sm leading-relaxed text-slate-500">
                                Setiap pengaduan dapat dilengkapi dengan foto bukti otentik dan tanggal kejadian yang jelas untuk mempermudah petugas saat memverifikasi lokasi.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200/90 bg-white p-8 transition duration-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-100">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-100 text-teal-700">
                                <i data-lucide="git-commit-horizontal" class="h-6 w-6"></i>
                            </span>
                            <h3 class="mt-6 font-display text-lg font-bold text-slate-900">Alur Status Transparan</h3>
                            <p class="mt-3 text-sm leading-relaxed text-slate-500">
                                Pantau perkembangan dari status <strong>Menunggu</strong>, <strong>Diproses</strong>, hingga <strong>Selesai</strong> tanpa ada langkah yang ditutup-tutupi.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200/90 bg-white p-8 transition duration-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-100">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                                <i data-lucide="lock" class="h-6 w-6"></i>
                            </span>
                            <h3 class="mt-6 font-display text-lg font-bold text-slate-900">Keamanan & Privasi Warga</h3>
                            <p class="mt-3 text-sm leading-relaxed text-slate-500">
                                Data identitas warga tersimpan dengan standar keamanan tinggi dan terisolasi dari akses publik umum, hanya dapat ditinjau oleh administrator berwenang.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Section: Cara Melapor / Alur Kerja (#cara-kerja) --}}
            <section id="cara-kerja" class="bg-slate-50/70 py-20 lg:py-28">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="mx-auto max-w-2xl text-center">
                        <span class="inline-block rounded-full bg-emerald-50 px-3.5 py-1 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                            ALUR KERJA
                        </span>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            4 Langkah Mudah Menyampaikan Pengaduan
                        </h2>
                        <p class="mt-4 text-base text-slate-500 leading-relaxed">
                            Proses pelaporan dirancang ringkas dan terarah agar laporan Anda dapat segera ditindaklanjuti oleh petugas.
                        </p>
                    </div>

                    <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 font-display text-sm font-extrabold text-white">
                                01
                            </span>
                            <h3 class="mt-5 font-display text-base font-bold text-slate-900">Daftar / Masuk</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Daftarkan akun warga menggunakan email, nomor WhatsApp aktif, dan alamat domisili Anda.
                            </p>
                        </div>

                        <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 font-display text-sm font-extrabold text-white">
                                02
                            </span>
                            <h3 class="mt-5 font-display text-base font-bold text-slate-900">Tulis Laporan & Foto</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Isi judul, detail lokasi kejadian, tanggal, dan unggah foto bukti permasalahan lingkungan yang ditemui.
                            </p>
                        </div>

                        <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 font-display text-sm font-extrabold text-white">
                                03
                            </span>
                            <h3 class="mt-5 font-display text-base font-bold text-slate-900">Verifikasi Petugas</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Administrator meninjau keabsahan bukti dan mengalihkan status ke tahap penanganan di lapangan.
                            </p>
                        </div>

                        <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 font-display text-sm font-extrabold text-white">
                                04
                            </span>
                            <h3 class="mt-5 font-display text-base font-bold text-slate-900">Selesai Dituntaskan</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Setelah penanganan fisik rampung, laporan ditandai selesai dan tercatat resmi dalam sistem arsip.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Section: Tahapan Status (#status) --}}
            <section id="status" class="py-20 lg:py-28">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="mx-auto max-w-2xl text-center">
                        <span class="inline-block rounded-full bg-emerald-50 px-3.5 py-1 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                            TRANSPARANSI TAHAPAN
                        </span>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Memahami Siklus Status Pengaduan
                        </h2>
                        <p class="mt-4 text-base text-slate-500 leading-relaxed">
                            Setiap laporan mengikuti siklus resmi satu arah yang dapat dipantau langsung dari dashboard warga.
                        </p>
                    </div>

                    <div class="mt-16 grid gap-6 md:grid-cols-3">
                        <div class="rounded-2xl border border-amber-200/80 bg-gradient-to-br from-amber-50/50 to-white p-7">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">
                                <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Peninjauan
                            </span>
                            <h3 class="mt-4 font-display text-lg font-bold text-slate-900">Tahap 1: Pending</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600">
                                Laporan baru saja diajukan dan sedang dalam antrean verifikasi awal oleh administrator. Warga masih dapat memperbaiki atau menghapus laporan pada tahap ini.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-sky-200/80 bg-gradient-to-br from-sky-50/50 to-white p-7">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-100 px-3 py-1 text-xs font-bold text-sky-800">
                                <span class="h-2 w-2 rounded-full bg-sky-500 animate-spin"></span>
                                Sedang Diproses
                            </span>
                            <h3 class="mt-4 font-display text-lg font-bold text-slate-900">Tahap 2: Proses</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600">
                                Laporan telah diverifikasi valid dan petugas terkait sedang melakukan tindak lanjut di lapangan. Laporan dikunci agar data historis tetap konsisten.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50/50 to-white p-7">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Selesai Ditangani
                            </span>
                            <h3 class="mt-4 font-display text-lg font-bold text-slate-900">Tahap 3: Selesai</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600">
                                Masalah lingkungan telah selesai diperbaiki atau ditangani oleh pihak berwenang. Catatan penyelesaian tersimpan secara permanen untuk evaluasi pelayanan.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Section: FAQ --}}
            <section id="faq" class="bg-slate-50/70 py-20 lg:py-28">
                <div class="mx-auto max-w-4xl px-6 lg:px-10">
                    <div class="text-center">
                        <span class="inline-block rounded-full bg-emerald-50 px-3.5 py-1 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                            PERTANYAAN UMUM
                        </span>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Pertanyaan yang Sering Diajukan
                        </h2>
                    </div>

                    <div class="mt-12 space-y-4">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <h3 class="font-display text-base font-bold text-slate-900">Apakah ada biaya untuk membuat pengaduan?</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Tidak ada. Seluruh layanan pengaduan dan aspirasi warga di sistem E-Report 100% gratis dan terbuka bagi seluruh warga terdaftar.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <h3 class="font-display text-base font-bold text-slate-900">Apakah saya bisa mengubah laporan setelah dikirim?</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Ya, Anda dapat mengubah isi laporan dan mengganti foto bukti selama status laporan masih dalam tahap <strong>Menunggu</strong>. Begitu petugas memproses laporan, isi pengaduan akan dikunci demi akuntabilitas investigasi.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs">
                            <h3 class="font-display text-base font-bold text-slate-900">Bagaimana jika saya tidak melampirkan foto bukti?</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-500">
                                Foto bersifat opsional, namun sangat disarankan untuk melampirkan foto bukti agar petugas dapat mengidentifikasi masalah dan lokasi secara lebih presisi.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA Banner Section --}}
            <section class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 py-16 text-white">
                <div class="mx-auto max-w-7xl px-6 text-center lg:px-10">
                    <h2 class="font-display text-3xl font-extrabold tracking-tight sm:text-4xl">
                        Siap Mewujudkan Lingkungan yang Lebih Baik?
                    </h2>
                    <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-emerald-200">
                        Jangan biarkan keluhan fasilitas umum terabaikan. Daftarkan diri Anda dan sampaikan aspirasi pertama Anda sekarang.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a
                            href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-emerald-900 shadow-lg transition hover:bg-emerald-50 active:scale-95"
                        >
                            <span>Daftar Akun Warga</span>
                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </a>
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-emerald-400/40 bg-emerald-950/40 px-7 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-950/60"
                        >
                            <span>Masuk ke Akun</span>
                        </a>
                    </div>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 bg-white py-12 text-slate-600">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="grid gap-8 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 font-display text-xl font-extrabold text-slate-900">
                            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-xs">
                                <i data-lucide="shield-check" class="h-5 w-5"></i>
                            </span>
                            <span>E-Report<span class="text-emerald-600">.</span></span>
                        </a>
                        <p class="mt-4 max-w-sm text-xs leading-relaxed text-slate-500">
                            Sistem Informasi Pengaduan & Layanan Aspirasi Warga. Menghubungkan partisipasi masyarakat dengan responsivitas pemerintah lingkungan.
                        </p>
                        <p class="mt-4 text-[11px] text-slate-400">
                            Tugas Akhir Semester 1 — TRPL Politeknik IDN · Mahasiswa: Allam Permata Putra (NIM: 260558302016)
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-900">Navigasi Cepat</p>
                        <ul class="mt-4 space-y-2 text-xs">
                            <li><a href="#tentang" class="hover:text-emerald-600 transition">Tentang Kami</a></li>
                            <li><a href="#cara-kerja" class="hover:text-emerald-600 transition">Alur Pelaporan</a></li>
                            <li><a href="#status" class="hover:text-emerald-600 transition">Tahapan Status</a></li>
                            <li><a href="#faq" class="hover:text-emerald-600 transition">FAQ</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-900">Akses Pengguna</p>
                        <ul class="mt-4 space-y-2 text-xs">
                            <li><a href="{{ route('login') }}" class="hover:text-emerald-600 transition">Masuk Akun</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-emerald-600 transition">Registrasi Warga</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-emerald-600 transition">Portal Administrator</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-slate-100 pt-8 text-xs text-slate-400 sm:flex-row">
                    <p>© {{ date('Y') }} E-Report. Seluruh hak cipta dilindungi.</p>
                    <p>Suara Warga, Langkah Perubahan.</p>
                </div>
            </div>
        </footer>

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
