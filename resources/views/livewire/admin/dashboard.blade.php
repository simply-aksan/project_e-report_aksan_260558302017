<div wire:poll.30s class="space-y-8">
    {{-- Top Executive Banner --}}
    <div class="relative overflow-hidden rounded-3xl border border-slate-800 bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-950 p-6 text-white shadow-xl sm:p-8">
        {{-- Ambient decorative circle --}}
        <div class="pointer-events-none absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-emerald-500/15 blur-2xl"></div>

        <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1 text-xs font-semibold text-emerald-300 border border-white/10 backdrop-blur-md">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pusat Kendali Pengaduan Lingkungan</span>
                </div>
                <h1 class="font-display text-2xl font-extrabold tracking-tight sm:text-3xl">
                    Dashboard Administrator
                </h1>
                <p class="max-w-xl text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Pantau alur pengaduan warga secara real-time, verifikasi bukti lapangan, dan koordinasikan penanganan bersama tim terkait.
                </p>
            </div>

            <div class="shrink-0">
                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="group inline-flex items-center gap-2.5 rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 transition-all duration-150 hover:bg-emerald-500 active:scale-95"
                >
                    <span>Kelola Seluruh Pengaduan</span>
                    <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- 5 KPI Metric Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        {{-- Total Pengaduan --}}
        <div class="relative overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-5 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Laporan</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700">
                    <i data-lucide="files" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-slate-900">
                {{ number_format($total) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-400">
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Menunggu --}}
        <div class="relative overflow-hidden rounded-2xl border border-amber-200/80 bg-gradient-to-br from-amber-50/40 via-white to-white p-5 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Menunggu</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                    <i data-lucide="clock" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-amber-900">
                {{ number_format($stats['pending']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-amber-600 font-medium">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Sedang Diproses --}}
        <div class="relative overflow-hidden rounded-2xl border border-sky-200/80 bg-gradient-to-br from-sky-50/40 via-white to-white p-5 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider">Sedang Diproses</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-700">
                    <i data-lucide="loader-2" class="h-5 w-5 animate-spin"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-sky-900">
                {{ number_format($stats['proses']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-sky-600 font-medium">
                <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="relative overflow-hidden rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50/40 via-white to-white p-5 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Selesai</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                    <i data-lucide="check-circle" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-emerald-900">
                {{ number_format($stats['selesai']) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                <span>Pengaduan tercatat</span>
            </div>
        </div>

        {{-- Warga Terdaftar --}}
        <div class="relative overflow-hidden rounded-2xl border border-indigo-200/80 bg-gradient-to-br from-indigo-50/40 via-white to-white p-5 shadow-xs transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Warga Terdaftar</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700">
                    <i data-lucide="users" class="h-5 w-5"></i>
                </span>
            </div>
            <p class="mt-4 font-display text-3xl font-extrabold tracking-tight text-indigo-900">
                {{ number_format($citizens) }}
            </p>
            <div class="mt-2 flex items-center gap-1.5 text-xs text-indigo-600">
                <span>Akun warga aktif</span>
            </div>
        </div>
    </div>

    {{-- 2-Column Analytics & Callout --}}
    <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">
        {{-- Status Progress Bars --}}
        <section class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-display font-bold text-slate-900 text-base">Distribusi Status Pengaduan</h2>
                    <p class="mt-0.5 text-xs text-slate-400">Persentase tahapan seluruh laporan yang masuk ke sistem</p>
                </div>
                <span class="rounded-xl bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                    Total: {{ $total }}
                </span>
            </div>

            <div class="mt-6 space-y-5">
                @foreach(\App\Models\Laporan::STATUSES as $status => $label)
                    @php
                        $percentage = $total ? round($stats[$status] / $total * 100) : 0;
                    @endphp
                    <div>
                        <div class="mb-1.5 flex justify-between text-xs">
                            <span class="font-semibold text-slate-700 flex items-center gap-1.5">
                                <span @class([
                                    'h-2 w-2 rounded-full',
                                    'bg-amber-500' => $status === 'pending',
                                    'bg-sky-500' => $status === 'proses',
                                    'bg-emerald-500' => $status === 'selesai',
                                ])></span>
                                {{ $label }}
                            </span>
                            <span class="font-bold text-slate-900">
                                {{ $stats[$status] }}
                                <span class="font-normal text-slate-400 ml-1">({{ $percentage }}%)</span>
                            </span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100" role="meter" aria-label="{{ $label }}" aria-valuenow="{{ $stats[$status] }}" aria-valuemin="0" aria-valuemax="{{ max(1, $total) }}">
                            <div
                                @class([
                                    'h-full rounded-full transition-all duration-500',
                                    'bg-amber-400' => $status === 'pending',
                                    'bg-sky-500' => $status === 'proses',
                                    'bg-emerald-500' => $status === 'selesai',
                                ])
                                style="width: {{ $percentage }}%"
                            ></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Attention Needed Callout --}}
        <section class="flex flex-col justify-between rounded-3xl bg-gradient-to-br from-slate-900 via-slate-950 to-emerald-950 p-6 text-white shadow-xl">
            <div>
                <span class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-3 py-1.5 text-xs font-bold text-amber-300 border border-white/10">
                    <i data-lucide="alert-circle" class="h-4 w-4"></i>
                    <span>Tindakan Diperlukan</span>
                </span>
                <p class="mt-4 font-display text-xl font-bold">
                    {{ $stats['pending'] }} Pengaduan Menunggu Verifikasi
                </p>
                <p class="mt-2 text-xs leading-relaxed text-slate-300">
                    Segera periksa bukti laporan yang baru diajukan oleh warga untuk memulai proses investigasi dan penanganan teknis di lapangan.
                </p>
            </div>

            <div class="pt-6">
                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-xs font-bold text-white shadow-md transition hover:bg-emerald-500"
                >
                    <span>Tinjau Daftar Pengaduan</span>
                    <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1"></i>
                </a>
            </div>
        </section>
    </div>

    {{-- Laporan Terbaru --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="font-display text-base font-bold text-slate-900">Pengaduan Masuk Terbaru</h2>
                <p class="mt-0.5 text-xs text-slate-400">Laporan terbaru yang diajukan oleh warga lingkungan</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                <span>Buka Seluruh Laporan</span>
                <i data-lucide="arrow-right" class="h-3.5 w-3.5 transition group-hover:translate-x-0.5"></i>
            </a>
        </div>

        @if($recent->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="inbox" class="h-8 w-8"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Belum Ada Pengaduan Masuk</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">
                    Sistem belum menerima laporan pengaduan baru dari warga.
                </p>
            </div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach($recent as $laporan)
                    <div wire:key="admin-recent-{{ $laporan->id }}" class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between transition hover:bg-slate-50/60">
                        <div class="flex items-start gap-3.5">
                            @if($laporan->foto)
                                <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Bukti" class="h-12 w-12 rounded-xl object-cover shrink-0 border border-slate-200">
                            @else
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                    <i data-lucide="image" class="h-5 w-5"></i>
                                </div>
                            @endif

                            <div>
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="font-extrabold tracking-wider text-slate-400 text-[10px]">
                                        #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="font-semibold text-slate-700">
                                        {{ $laporan->pelapor->name }}
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-slate-400 text-[11px]">
                                        {{ $laporan->created_at->translatedFormat('d M Y, H:i') }}
                                    </span>
                                </div>
                                <a
                                    href="{{ route('admin.laporan.show', $laporan) }}"
                                    class="mt-1 block font-semibold text-sm text-slate-900 hover:text-emerald-600 transition"
                                >
                                    {{ $laporan->judul }}
                                </a>
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
                                href="{{ route('admin.laporan.show', $laporan) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition"
                            >
                                <span>Tinjau</span>
                                <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
