<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                <span>MANAJEMEN ADMINISTRASI</span>
            </div>
            <h1 class="mt-1 font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                Semua Pengaduan Warga
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Tinjau data pengaduan seluruh warga lingkungan, hubungi pelapor, dan perbarui tahapan status penanganan.
            </p>
        </div>
    </div>

    {{-- Filter Toolbar --}}
    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200/90 bg-white p-3.5 shadow-xs lg:flex-row lg:items-center">
        {{-- Search Input (Search Title or Citizen Name) --}}
        <div class="relative flex-1">
            <label for="search" class="sr-only">Cari pengaduan atau nama warga</label>
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i data-lucide="search" class="h-4 w-4"></i>
            </span>
            <input
                id="search"
                type="search"
                wire:model.live.debounce.350ms="search"
                placeholder="Cari judul laporan atau nama warga pelapor…"
                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 pr-4 pl-10 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-3 focus:ring-emerald-500/10 focus:outline-none"
            >
        </div>

        <div class="flex flex-wrap items-center gap-3">
            {{-- Status Filter --}}
            <div>
                <label for="status" class="sr-only">Filter status</label>
                <select
                    id="status"
                    wire:model.live="status"
                    class="rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-xs sm:text-sm font-medium text-slate-700 focus:border-emerald-500 focus:bg-white focus:ring-3 focus:ring-emerald-500/10 focus:outline-none"
                >
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Sort Filter --}}
            <div>
                <label for="sort" class="sr-only">Urutkan</label>
                <select
                    id="sort"
                    wire:model.live="sort"
                    class="rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-xs sm:text-sm font-medium text-slate-700 focus:border-emerald-500 focus:bg-white focus:ring-3 focus:ring-emerald-500/10 focus:outline-none"
                >
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>

            {{-- Loading Indicator --}}
            <div wire:loading role="status" class="flex items-center gap-1.5 px-2 text-xs font-semibold text-emerald-600">
                <i data-lucide="loader-2" class="h-3.5 w-3.5 animate-spin"></i>
                <span class="hidden sm:inline">Memuat…</span>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-xs">
        @if($laporans->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="inbox" class="h-8 w-8"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Tidak ada pengaduan yang cocok</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">
                    Tidak ditemukan data pengaduan dengan filter atau kata kunci saat ini.
                </p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            <th scope="col" class="px-6 py-4">Pengaduan</th>
                            <th scope="col" class="px-4 py-4">Warga Pelapor</th>
                            <th scope="col" class="px-4 py-4">Tgl Kejadian</th>
                            <th scope="col" class="px-4 py-4">Status</th>
                            <th scope="col" class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($laporans as $laporan)
                            <tr wire:key="admin-laporan-{{ $laporan->id }}" class="transition hover:bg-slate-50/60">
                                {{-- Pengaduan --}}
                                <td class="px-6 py-4 max-w-sm">
                                    <div class="flex items-start gap-3">
                                        @if($laporan->foto)
                                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Bukti" class="h-11 w-11 rounded-xl object-cover shrink-0 border border-slate-200 mt-0.5">
                                        @else
                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400 mt-0.5">
                                                <i data-lucide="image" class="h-5 w-5"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <span class="text-[10px] font-extrabold tracking-wider text-slate-400">
                                                #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <a
                                                href="{{ route('admin.laporan.show', $laporan) }}"
                                                class="block font-semibold text-slate-900 hover:text-emerald-600 transition truncate"
                                            >
                                                {{ $laporan->judul }}
                                            </a>
                                            <p class="text-xs text-slate-400 truncate mt-0.5">
                                                {{ $laporan->detail }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Warga Pelapor --}}
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-800">
                                            {{ mb_substr($laporan->pelapor->name, 0, 1) }}
                                        </span>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">{{ $laporan->pelapor->name }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $laporan->pelapor->email }}</p>
                                            @if($laporan->pelapor->no_whatsapp)
                                                <a
                                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $laporan->pelapor->no_whatsapp) }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="inline-flex items-center gap-1 text-[10px] font-semibold text-emerald-600 hover:underline mt-0.5"
                                                >
                                                    <i data-lucide="message-circle" class="h-3 w-3"></i>
                                                    <span>{{ $laporan->pelapor->no_whatsapp }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-4 py-4 text-xs font-medium text-slate-600 whitespace-nowrap">
                                    <div>{{ $laporan->tanggal->translatedFormat('d M Y') }}</div>
                                    <div class="text-[10px] text-slate-400">Diajukan: {{ $laporan->created_at->translatedFormat('d/m/y H:i') }}</div>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 whitespace-nowrap">
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
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a
                                        href="{{ route('admin.laporan.show', $laporan) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-3.5 py-1.5 text-xs font-bold text-white shadow-xs transition hover:bg-emerald-700"
                                    >
                                        <i data-lucide="check-square" class="h-3.5 w-3.5"></i>
                                        <span>Tinjau</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($laporans->hasPages())
                <div class="border-t border-slate-100 px-6 py-4 bg-slate-50/50">
                    {{ $laporans->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
