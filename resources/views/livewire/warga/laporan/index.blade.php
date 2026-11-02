<div class="space-y-6">
    {{-- Header Page --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                <span>MANAJEMEN LAPORAN</span>
            </div>
            <h1 class="mt-1 font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                Pengaduan Saya
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Daftar seluruh laporan keluhan lingkungan yang pernah Anda kirimkan beserta status penanganannya.
            </p>
        </div>

        <a
            href="{{ route('warga.laporan.create') }}"
            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition-all duration-150 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-600/35 active:scale-95"
        >
            <i data-lucide="plus-circle" class="h-4 w-4 transition group-hover:rotate-90"></i>
            <span>Buat Pengaduan Baru</span>
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div role="status" class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/90 p-4 text-sm font-medium text-emerald-900 shadow-xs">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                <i data-lucide="check" class="h-4 w-4"></i>
            </span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Filter & Search Toolbar --}}
    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200/90 bg-white p-3.5 shadow-xs sm:flex-row sm:items-center">
        {{-- Search Input --}}
        <div class="relative flex-1">
            <label for="search" class="sr-only">Cari pengaduan</label>
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i data-lucide="search" class="h-4 w-4"></i>
            </span>
            <input
                id="search"
                type="search"
                wire:model.live.debounce.350ms="search"
                placeholder="Cari berdasarkan judul pengaduan…"
                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 pr-4 pl-10 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-3 focus:ring-emerald-500/10 focus:outline-none"
            >
        </div>

        {{-- Status Filter --}}
        <div class="flex items-center gap-2">
            <label for="status" class="sr-only">Filter status</label>
            <select
                id="status"
                wire:model.live="status"
                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-xs sm:text-sm font-medium text-slate-700 focus:border-emerald-500 focus:bg-white focus:ring-3 focus:ring-emerald-500/10 focus:outline-none sm:w-48"
            >
                <option value="">Semua Status</option>
                @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading role="status" class="flex items-center gap-1.5 px-2 text-xs font-semibold text-emerald-600">
            <i data-lucide="loader-2" class="h-3.5 w-3.5 animate-spin"></i>
            <span>Menyaring data…</span>
        </div>
    </div>

    {{-- Main Content Table / Card List --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-xs">
        @if($laporans->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="inbox" class="h-8 w-8"></i>
                </div>
                <h3 class="font-display text-base font-bold text-slate-800">Tidak ada pengaduan yang cocok</h3>
                <p class="mx-auto mt-1 max-w-sm text-xs leading-relaxed text-slate-500">
                    Coba sesuaikan kata kunci pencarian atau ubah filter status untuk menemukan laporan.
                </p>
                <div class="mt-6 flex justify-center gap-3">
                    <a
                        href="{{ route('warga.laporan.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm shadow-emerald-600/30 transition hover:bg-emerald-700"
                    >
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Buat Pengaduan</span>
                    </a>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            <th scope="col" class="px-6 py-4">Pengaduan</th>
                            <th scope="col" class="px-4 py-4">Tgl Kejadian</th>
                            <th scope="col" class="px-4 py-4">Tgl Pengajuan</th>
                            <th scope="col" class="px-4 py-4">Status Progres</th>
                            <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($laporans as $laporan)
                            <tr wire:key="laporan-{{ $laporan->id }}" class="transition hover:bg-slate-50/60">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3.5">
                                        @if($laporan->foto)
                                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Bukti" class="h-12 w-12 rounded-xl object-cover shrink-0 border border-slate-200">
                                        @else
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                                <i data-lucide="image" class="h-5 w-5"></i>
                                            </div>
                                        @endif
                                        <div class="max-w-md">
                                            <span class="text-[10px] font-extrabold tracking-wider text-slate-400">
                                                #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <a
                                                href="{{ route('warga.laporan.show', $laporan) }}"
                                                class="mt-0.5 block font-semibold text-slate-800 hover:text-emerald-600 transition truncate max-w-sm"
                                            >
                                                {{ $laporan->judul }}
                                            </a>
                                            <p class="mt-0.5 text-xs text-slate-400 truncate max-w-sm">
                                                {{ $laporan->detail }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-xs font-medium text-slate-600 whitespace-nowrap">
                                    {{ $laporan->tanggal->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-4 py-4 text-xs text-slate-400 whitespace-nowrap">
                                    {{ $laporan->created_at->translatedFormat('d M Y, H:i') }}
                                </td>
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
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        {{-- Detail Button --}}
                                        <a
                                            href="{{ route('warga.laporan.show', $laporan) }}"
                                            title="Lihat Detail Pengaduan"
                                            class="inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition"
                                        >
                                            <i data-lucide="eye" class="h-3.5 w-3.5"></i>
                                            <span>Lihat</span>
                                        </a>

                                        {{-- Edit Button (only if pending) --}}
                                        @if($laporan->status === 'pending')
                                            <a
                                                href="{{ route('warga.laporan.edit', $laporan) }}"
                                                title="Edit Pengaduan"
                                                class="inline-flex items-center gap-1 rounded-lg border border-amber-200 bg-amber-50/70 px-2.5 py-1.5 text-xs font-semibold text-amber-800 hover:bg-amber-100 transition"
                                            >
                                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                                <span>Edit</span>
                                            </a>

                                            {{-- Delete Button (only if pending) --}}
                                            <button
                                                type="button"
                                                wire:click="delete({{ $laporan->id }})"
                                                wire:confirm="Yakin ingin membatalkan dan menghapus pengaduan ini secara permanen?"
                                                title="Hapus Pengaduan"
                                                class="inline-flex items-center gap-1 rounded-lg border border-rose-200 bg-rose-50/70 px-2.5 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-100 transition"
                                            >
                                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                                <span>Hapus</span>
                                            </button>
                                        @endif
                                    </div>
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
