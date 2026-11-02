<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#059669">
        <title>Akses Dibatasi · E-Report Layanan Aspirasi Warga</title>
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
            }
        </style>
    </head>
    <body class="flex min-h-screen items-center justify-center bg-gradient-to-b from-slate-50 to-slate-100 px-6 font-sans text-slate-900">
        <main class="w-full max-w-md text-center">
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-md shadow-emerald-500/20">
                        <i data-lucide="shield-check" class="h-6 w-6"></i>
                    </span>
                    <span class="text-xl">E-Report<span class="text-emerald-600">.</span></span>
                </a>
            </div>

            <div class="rounded-3xl border border-slate-200/90 bg-white p-8 shadow-xl">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 mb-6">
                    <i data-lucide="shield-alert" class="h-8 w-8"></i>
                </div>

                <p class="font-display text-5xl font-extrabold text-rose-600">403</p>
                <h1 class="mt-4 font-display text-xl font-bold text-slate-900">Akses halaman dibatasi</h1>
                <p class="mt-2 text-xs leading-relaxed text-slate-500">
                    Anda tidak memiliki izin untuk mengakses atau melakukan perubahan pada bagian ini.
                </p>

                <div class="mt-8 flex flex-col gap-2.5">
                    <a
                        href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('home') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700 transition"
                    >
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Kembali ke {{ auth()->check() ? 'Dashboard' : 'Beranda' }}</span>
                    </a>
                </div>
            </div>

            <p class="mt-6 text-xs text-slate-400">© {{ date('Y') }} E-Report · Suara Warga, Langkah Perubahan.</p>
        </main>

        <script src="{{ asset('assets/lucide.min.js') }}"></script>
        <script>
            if (window.lucide) { window.lucide.createIcons(); }
        </script>
    </body>
</html>
