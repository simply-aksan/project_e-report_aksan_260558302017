<div class="space-y-6">
    {{-- Header & Breadcrumbs --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('warga.laporan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-emerald-600 transition">
                <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
                <span>Kembali ke Daftar Pengaduan</span>
            </a>
            <div class="mt-2 flex flex-wrap items-center gap-3">
                <h1 class="font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    Detail Pengaduan
                </h1>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                    #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Informasi lengkap mengenai status penanganan dan kronologi laporan Anda.
            </p>
        </div>

        {{-- Action Buttons if Pending --}}
        @if($laporan->status === 'pending')
            <div class="flex items-center gap-2">
                <a
                    href="{{ route('warga.laporan.edit', $laporan) }}"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-xs font-bold text-amber-800 transition hover:bg-amber-100"
                >
                    <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                    <span>Edit Pengaduan</span>
                </a>

                <button
                    type="button"
                    wire:click="delete"
                    wire:confirm="Yakin ingin membatalkan dan menghapus pengaduan ini secara permanen?"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-2.5 text-xs font-bold text-rose-700 transition hover:bg-rose-100"
                >
                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                    <span>Batalkan Laporan</span>
                </button>
            </div>
        @endif
    </div>

    {{-- Main 2-Column Content --}}
    <div class="grid items-start gap-8 lg:grid-cols-[1fr_340px]">
        {{-- Left: Report Details Card --}}
        <article class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white shadow-xs">
            <div class="border-b border-slate-100 p-6 sm:p-8">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <span class="text-xs font-extrabold tracking-wider text-slate-400 uppercase">
                        BERKAS PENGADUAN #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
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
                </div>

                <h2 class="mt-4 font-display text-2xl font-bold leading-snug text-slate-900 break-words">
                    {{ $laporan->judul }}
                </h2>

                <div class="mt-6 grid gap-4 rounded-2xl bg-slate-50/70 p-4 text-xs text-slate-600 sm:grid-cols-2">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="calendar" class="h-4 w-4 text-emerald-600 shrink-0"></i>
                        <span>Tanggal Kejadian: <strong class="text-slate-800">{{ $laporan->tanggal->translatedFormat('d F Y') }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="clock" class="h-4 w-4 text-slate-400 shrink-0"></i>
                        <span>Diajukan Pada: <strong class="text-slate-800">{{ $laporan->created_at->translatedFormat('d M Y, H:i') }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                {{-- Detail Text --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                        Deskripsi & Rincian Masalah
                    </h3>
                    <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line break-words bg-slate-50/40 p-4 rounded-2xl border border-slate-100">
                        {{ $laporan->detail }}
                    </p>
                </div>

                {{-- Foto Bukti --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                        Foto Bukti Kejadian
                    </h3>
                    @if($laporan->foto)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 text-center">
                            <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener" class="group relative block">
                                <img
                                    src="{{ Storage::disk('public')->url($laporan->foto) }}"
                                    alt="Foto bukti pengaduan: {{ $laporan->judul }}"
                                    class="max-h-[460px] w-full object-contain transition duration-200 group-hover:opacity-95"
                                >
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition duration-150">
                                    <span class="inline-flex items-center gap-2 rounded-xl bg-white/90 px-4 py-2 text-xs font-bold text-slate-900 shadow-md">
                                        <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                                        <span>Buka Ukuran Penuh</span>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <p class="mt-2 text-[11px] text-slate-400">Klik gambar di atas untuk melihat foto ukuran penuh di tab baru.</p>
                    @else
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-6 text-xs text-slate-400">
                            <i data-lucide="image-off" class="h-5 w-5 shrink-0"></i>
                            <span>Tidak ada berkas foto bukti yang dilampirkan dalam pengaduan ini.</span>
                        </div>
                    @endif
                </div>
            </div>
        </article>

        {{-- Right: Status Progression Stepper --}}
        <aside class="space-y-6">
            <section class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-900">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <i data-lucide="activity" class="h-4 w-4"></i>
                    </span>
                    <h2 class="font-display text-sm font-bold">Progres Penanganan</h2>
                </div>

                {{-- Stepper Items --}}
                <div class="mt-6 space-y-6 relative before:absolute before:left-4 before:top-4 before:bottom-4 before:w-0.5 before:bg-slate-100">
                    @foreach(['pending' => ['clock', 'Menunggu Peninjauan'], 'proses' => ['loader-2', 'Sedang Diproses'], 'selesai' => ['check-circle-2', 'Selesai Ditangani']] as $status => [$icon, $label])
                        @php $reached = array_search($laporan->status, ['pending','proses','selesai']) >= $loop->index; @endphp
                        <div class="relative flex items-start gap-3.5">
                            <span @class([
                                'flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs font-bold transition z-10',
                                'bg-emerald-600 text-white shadow-sm shadow-emerald-500/30 ring-4 ring-white' => $reached,
                                'bg-slate-100 text-slate-300 ring-4 ring-white' => !$reached,
                            ])>
                                <i data-lucide="{{ $icon }}" class="h-4 w-4"></i>
                            </span>
                            <div class="pt-0.5">
                                <p @class([
                                    'text-xs font-bold',
                                    'text-slate-900' => $reached,
                                    'text-slate-400' => !$reached,
                                ])>
                                    {{ $label }}
                                </p>
                                @if($laporan->status === $status)
                                    <span class="mt-0.5 inline-block text-[11px] font-semibold text-emerald-600">
                                        ● Tahap aktif saat ini
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 rounded-2xl bg-emerald-50/70 p-4 border border-emerald-100">
                    <p class="text-xs leading-relaxed text-emerald-900">
                        {{ $laporan->statusDescription() }}
                    </p>
                </div>
            </section>
        </aside>
    </div>
</div>
