<div class="space-y-6">
    {{-- Top Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-emerald-600 transition">
                <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
                <span>Kembali ke Semua Pengaduan</span>
            </a>
            <div class="mt-2 flex flex-wrap items-center gap-3">
                <h1 class="font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    Tinjau & Tindak Lanjut Pengaduan
                </h1>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                    #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Verifikasi keabsahan laporan warga dan perbarui tahapan penyelesaian masalah di lapangan.
            </p>
        </div>

        <a
            href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-xs hover:bg-slate-50 transition"
        >
            <i data-lucide="list" class="h-3.5 w-3.5"></i>
            <span>Daftar Pengaduan</span>
        </a>
    </div>

    {{-- Flash Status Alert --}}
    @if(session('success'))
        <div role="status" class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/90 p-4 text-sm font-medium text-emerald-900 shadow-xs">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                <i data-lucide="check" class="h-4 w-4"></i>
            </span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Error Alert --}}
    @error('status')
        <div role="alert" class="flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50/90 p-4 text-sm font-medium text-rose-900 shadow-xs">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-rose-600 text-white">
                <i data-lucide="alert-triangle" class="h-4 w-4"></i>
            </span>
            <span>{{ $message }}</span>
        </div>
    @enderror

    {{-- 2-Column Layout --}}
    <div class="grid items-start gap-8 lg:grid-cols-[1fr_340px]">
        {{-- Left: Case Details & Photo Evidence --}}
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
                        <span>Kejadian: <strong class="text-slate-800">{{ $laporan->tanggal->translatedFormat('d F Y') }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="clock" class="h-4 w-4 text-slate-400 shrink-0"></i>
                        <span>Diajukan: <strong class="text-slate-800">{{ $laporan->created_at->translatedFormat('d M Y, H:i') }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                {{-- Detail Masalah --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                        Deskripsi Pengaduan Warga
                    </h3>
                    <p class="text-sm leading-relaxed text-slate-700 whitespace-pre-line break-words bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        {{ $laporan->detail }}
                    </p>
                </div>

                {{-- Foto Bukti --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                        Foto Bukti di Lapangan
                    </h3>
                    @if($laporan->foto)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 text-center">
                            <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener" class="group relative block">
                                <img
                                    src="{{ Storage::disk('public')->url($laporan->foto) }}"
                                    alt="Foto bukti: {{ $laporan->judul }}"
                                    class="max-h-[500px] w-full object-contain transition duration-200 group-hover:opacity-95"
                                >
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition duration-150">
                                    <span class="inline-flex items-center gap-2 rounded-xl bg-white/90 px-4 py-2 text-xs font-bold text-slate-900 shadow-md">
                                        <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                                        <span>Buka Ukuran Penuh</span>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <p class="mt-2 text-[11px] text-slate-400">Klik foto untuk melihat dalam resolusi asli.</p>
                    @else
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-6 text-xs text-slate-400">
                            <i data-lucide="image-off" class="h-5 w-5 shrink-0"></i>
                            <span>Tidak ada foto bukti dilampirkan oleh warga.</span>
                        </div>
                    @endif
                </div>
            </div>
        </article>

        {{-- Right Column: Status Transition Actions & Citizen Contact --}}
        <aside class="space-y-6">
            {{-- Status Update Action Card --}}
            <section class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-900">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <i data-lucide="shield" class="h-4 w-4"></i>
                    </span>
                    <h2 class="font-display text-sm font-bold">Tindakan Administrator</h2>
                </div>

                <div class="mt-4">
                    @if($laporan->status === 'pending')
                        <div class="rounded-2xl bg-amber-50/70 p-4 border border-amber-200/80 mb-4 text-xs text-amber-900">
                            <p class="font-bold">Laporan Menunggu Verifikasi</p>
                            <p class="mt-1 text-[11px] leading-relaxed text-amber-800">
                                Pastikan bukti dan lokasi valid sebelum memulai proses penanganan resmi di lapangan.
                            </p>
                        </div>

                        <button
                            type="button"
                            wire:loading.attr="disabled"
                            wire:click="changeStatus('proses')"
                            wire:confirm="Mulai proses penanganan pengaduan ini? Warga tidak dapat mengedit setelahnya."
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-sky-600 px-5 py-3.5 text-xs font-bold text-white shadow-md shadow-sky-600/25 transition hover:bg-sky-700 active:scale-95 disabled:opacity-60"
                        >
                            <span wire:loading.remove wire:target="changeStatus('proses')" class="inline-flex items-center gap-2">
                                <i data-lucide="play" class="h-4 w-4"></i>
                                <span>Mulai Proses Penanganan</span>
                            </span>
                            <span wire:loading wire:target="changeStatus('proses')" class="inline-flex items-center gap-2">
                                <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                                <span>Memproses…</span>
                            </span>
                        </button>

                    @elseif($laporan->status === 'proses')
                        <div class="rounded-2xl bg-sky-50/70 p-4 border border-sky-200/80 mb-4 text-xs text-sky-900">
                            <p class="font-bold">Dalam Tahap Penanganan</p>
                            <p class="mt-1 text-[11px] leading-relaxed text-sky-800">
                                Setelah penanganan perbaikan selesai dilakukan secara fisik, tandai laporan ini sebagai selesai.
                            </p>
                        </div>

                        <button
                            type="button"
                            wire:loading.attr="disabled"
                            wire:click="changeStatus('selesai')"
                            wire:confirm="Tandai laporan ini telah selesai ditangani secara tuntas?"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3.5 text-xs font-bold text-white shadow-md shadow-emerald-600/25 transition hover:bg-emerald-700 active:scale-95 disabled:opacity-60"
                        >
                            <span wire:loading.remove wire:target="changeStatus('selesai')" class="inline-flex items-center gap-2">
                                <i data-lucide="check-circle" class="h-4 w-4"></i>
                                <span>Tandai Selesai Ditangani</span>
                            </span>
                            <span wire:loading wire:target="changeStatus('selesai')" class="inline-flex items-center gap-2">
                                <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                                <span>Menyelesaikan…</span>
                            </span>
                        </button>

                    @else
                        <div class="rounded-2xl bg-emerald-50/90 p-4 border border-emerald-200 text-center">
                            <span class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 mb-2">
                                <i data-lucide="check" class="h-5 w-5"></i>
                            </span>
                            <p class="font-bold text-xs text-emerald-900">Pengaduan Telah Selesai</p>
                            <p class="mt-1 text-[11px] text-emerald-700">
                                Seluruh rangkaian penanganan telah tuntas dan tercatat permanen di arsip.
                            </p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- Status Progression Stepper --}}
            <section class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
                <h3 class="font-display text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">
                    Alur Tahapan Laporan
                </h3>

                <div class="space-y-4">
                    @foreach(['pending' => ['clock', 'Menunggu Peninjauan'], 'proses' => ['loader-2', 'Sedang Diproses'], 'selesai' => ['check-circle-2', 'Selesai Ditangani']] as $status => [$icon, $label])
                        @php $reached = array_search($laporan->status, ['pending','proses','selesai']) >= $loop->index; @endphp
                        <div class="flex items-center gap-3">
                            <span @class([
                                'flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs font-bold',
                                'bg-emerald-600 text-white shadow-xs' => $reached,
                                'bg-slate-100 text-slate-300' => !$reached,
                            ])>
                                <i data-lucide="{{ $icon }}" class="h-4 w-4"></i>
                            </span>
                            <div>
                                <p @class([
                                    'text-xs font-semibold',
                                    'text-slate-800' => $reached,
                                    'text-slate-400' => !$reached,
                                ])>
                                    {{ $label }}
                                </p>
                                @if($laporan->status === $status)
                                    <span class="text-[10px] text-emerald-600 font-medium">Tahap saat ini</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 rounded-2xl bg-slate-50 p-3.5 border border-slate-100">
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $laporan->statusDescription() }}
                    </p>
                </div>
            </section>

            {{-- Citizen Contact Information --}}
            <section class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-900">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <i data-lucide="user" class="h-4 w-4"></i>
                    </span>
                    <h3 class="font-display text-sm font-bold">Identitas Warga Pelapor</h3>
                </div>

                <div class="mt-4 flex items-center gap-3 border-b border-slate-100 pb-4">
                    @if($laporan->pelapor->foto)
                        <img src="{{ Storage::disk('public')->url($laporan->pelapor->foto) }}" alt="Foto profil" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-800">
                            {{ mb_substr($laporan->pelapor->name, 0, 1) }}
                        </span>
                    @endif
                    <div>
                        <p class="text-xs font-bold text-slate-900">{{ $laporan->pelapor->name }}</p>
                        <p class="text-[11px] text-slate-400 break-all">{{ $laporan->pelapor->email }}</p>
                    </div>
                </div>

                <dl class="mt-4 space-y-3 text-xs">
                    <div>
                        <dt class="font-bold text-slate-400 text-[10px] uppercase">WhatsApp</dt>
                        <dd class="mt-0.5 font-medium text-slate-800">{{ $laporan->pelapor->no_whatsapp ?: 'Tidak tersedia' }}</dd>
                    </div>
                    <div>
                        <dt class="font-bold text-slate-400 text-[10px] uppercase">Alamat Domisili</dt>
                        <dd class="mt-0.5 text-slate-600 leading-relaxed break-words">{{ $laporan->pelapor->alamat ?: 'Tidak tersedia' }}</dd>
                    </div>
                </dl>

                @if($laporan->pelapor->no_whatsapp)
                    <div class="mt-5 pt-4 border-t border-slate-100">
                        <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $laporan->pelapor->no_whatsapp) }}?text={{ urlencode('Halo '.$laporan->pelapor->name.', mengenai pengaduan Anda (#'.str_pad($laporan->id, 5, '0', STR_PAD_LEFT).') di E-Report...') }}"
                            target="_blank"
                            rel="noopener"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-xs transition hover:bg-emerald-700"
                        >
                            <i data-lucide="message-circle" class="h-4 w-4"></i>
                            <span>Hubungi Warga via WhatsApp</span>
                        </a>
                    </div>
                @endif
            </section>
        </aside>
    </div>
</div>
