<div wire:poll.30s class="space-y-8">
    {{-- Top Welcome Banner --}}
    <div class="relative overflow-hidden rounded-3xl border border-emerald-100 bg-gradient-to-r from-emerald-800 via-teal-800 to-slate-900 p-6 text-white shadow-xl sm:p-8">
        {{-- Ambient decorative circle --}}
        <div class="pointer-events-none absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-emerald-500/20 blur-2xl"></div>

        <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-200 border border-emerald-400/30">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Dashboard Pelayanan Warga</span>
                </div>
                <h1 class="font-display text-2xl font-extrabold tracking-tight sm:text-3xl">
                    {{ 'Selamat Datang, '.auth()->user()->name.'!' }}
                </h1>
                <p class="max-w-xl text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Setiap laporan dan aspirasi yang Anda sampaikan sangat berharga untuk menciptakan lingkungan yang lebih tertib, bersih, dan nyaman.
                </p>
            </div>

            <div class="shrink-0">
                <a
                    href="{{ route('warga.laporan.create') }}"
                    class="group inline-flex items-center gap-2.5 rounded-2xl bg-white px-5 py-3.5 text-sm font-bold text-emerald-900 shadow-lg shadow-black/10 transition-all duration-150 hover:bg-emerald-50 active:scale-95"
                >
                    <i data-lucide="plus-circle" class="h-4.5 w-4.5 text-emerald-600 transition group-hover:rotate-90"></i>
                    <span>Buat Pengaduan Baru</span>
                </a>
            </div>
        </div>
    </div>

    {{-- 4 Stat Metric KPI Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        {{-- Total Pengaduan --}}
        <div class="relative overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-6 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pengaduan</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700">
                    <i data-lucide="layers" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-slate-900">
                {{ number_format($total) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                <i data-lucide="files" class="h-3.5 w-3.5 text-slate-400"></i>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Menunggu --}}
        <div class="relative overflow-hidden rounded-2xl border border-amber-200/80 bg-gradient-to-br from-amber-50/40 via-white to-white p-6 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Menunggu</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                    <i data-lucide="clock" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-amber-900">
                {{ number_format($stats['pending']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-amber-600">
                <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Sedang Diproses --}}
        <div class="relative overflow-hidden rounded-2xl border border-sky-200/80 bg-gradient-to-br from-sky-50/40 via-white to-white p-6 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider">Sedang Diproses</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-700">
                    <i data-lucide="loader-2" class="h-5 w-5 animate-spin"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-sky-900">
                {{ number_format($stats['proses']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-sky-600">
                <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="relative overflow-hidden rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50/40 via-white to-white p-6 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Selesai</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                    <i data-lucide="check-circle" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-emerald-900">
                {{ number_format($stats['selesai']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-emerald-600">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>
    </div>

    {{-- Quick Action / Civic Tip Strip --}}
    <div class="flex flex-col gap-4 rounded-2xl border border-emerald-200/80 bg-gradient-to-r from-emerald-50/80 via-teal-50/50 to-emerald-50/80 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3.5">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-xs">
                <i data-lucide="megaphone" class="h-5 w-5"></i>
            </span>
            <div>
                <p class="text-sm font-bold text-slate-900">Menemukan Masalah Baru di Lingkungan?</p>
                <p class="text-xs text-slate-600">Laporan yang dilengkapi foto dan alamat lengkap lebih cepat ditangani petugas.</p>
            </div>
        </div>
        <a
            href="{{ route('warga.laporan.create') }}"
            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-xs transition hover:bg-emerald-700"
        >
            <span>Kirim Laporan</span>
            <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
        </a>
    </div>

    {{-- Pengaduan Terbaru --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="font-display text-lg font-bold text-slate-900">Pengaduan Terbaru</h2>
                <p class="mt-0.5 text-xs text-slate-400">Daftar perkembangan terbaru dari pengaduan yang Anda ajukan</p>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                <span>Lihat Semua Pengaduan</span>
                <i data-lucide="arrow-right" class="h-3.5 w-3.5 transition group-hover:translate-x-0.5"></i>
            </a>
        </div>

        @if($recent->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="inbox" class="h-8 w-8"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Belum Ada Pengaduan</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">
                    Ada permasalahan sarana umum di sekitar Anda? Buat pengaduan pertama Anda sekarang.
                </p>
                <div class="mt-6">
                    <a
                        href="{{ route('warga.laporan.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm shadow-emerald-600/30 transition hover:bg-emerald-700"
                    >
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Buat Pengaduan Sekarang</span>
                    </a>
                </div>
            </div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach($recent as $laporan)
                    <div wire:key="recent-{{ $laporan->id }}" class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between transition hover:bg-slate-50/70">
                        <div class="flex items-start gap-3.5">
                            @if($laporan->foto)
                                <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Foto" class="h-14 w-14 rounded-xl object-cover shrink-0 border border-slate-200">
                            @else
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                    <i data-lucide="image" class="h-6 w-6"></i>
                                </div>
                            @endif

                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-extrabold tracking-wider text-slate-400">
                                        #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-[10px] text-slate-300">•</span>
                                    <span class="text-[11px] text-slate-400">
                                        {{ $laporan->created_at->translatedFormat('d M Y, H:i') }}
                                    </span>
                                </div>
                                <a
                                    href="{{ route('warga.laporan.show', $laporan) }}"
                                    class="mt-1 block font-semibold text-sm text-slate-800 hover:text-emerald-600 transition"
                                >
                                    {{ $laporan->judul }}
                                </a>
                                <p class="mt-1 text-xs text-slate-500 line-clamp-1 max-w-xl">
                                    {{ $laporan->detail }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between sm:justify-end gap-3 pt-2 sm:pt-0">
                            <span @class([
                                'inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold',
                                'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                                'bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-200' => $laporan->status === 'proses',
                                'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                            ])>
                                <span @class([
                                    'h-1.5 w-1.5 rounded-full',
                                    'bg-amber-500 animate-pulse' => $laporan->status === 'pending',
                                    'bg-sky-500 animate-spin' => $laporan->status === 'proses',
                                    'bg-emerald-500' => $laporan->status === 'selesai',
                                ])></span>
                                {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                            </span>

                            <a
                                href="{{ route('warga.laporan.show', $laporan) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700"
                            >
                                <span>Detail</span>
                                <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
