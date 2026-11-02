<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('warga.laporan.show', $laporan) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-emerald-600 transition">
                <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
                <span>Kembali ke Detail Pengaduan</span>
            </a>
            <div class="mt-2 flex items-center gap-2.5">
                <h1 class="font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    Perbarui Pengaduan
                </h1>
                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 border border-amber-200">
                    Menunggu Verifikasi
                </span>
            </div>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Pengaduan #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }} — Anda dapat memperbarui data laporan selama belum diproses oleh petugas.
            </p>
        </div>
    </div>

    {{-- Main 2-Column Layout --}}
    <div class="grid items-start gap-8 lg:grid-cols-[1fr_340px]">
        {{-- Edit Form --}}
        <form wire:submit="save" class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-xs">
            <div class="mb-6 border-b border-slate-100 pb-4">
                <h2 class="font-display text-lg font-bold text-slate-900">Perubahan Informasi Pengaduan</h2>
                <p class="text-xs text-slate-400">Pastikan seluruh data yang diperbaiki sudah akurat.</p>
            </div>

            <div class="space-y-6">
                {{-- Judul --}}
                <div>
                    <label for="judul" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Judul Pengaduan <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        aria-describedby="judul-help judul-error"
                        @error('judul') aria-invalid="true" @enderror
                        wire:model="judul"
                        maxlength="255"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                    <p id="judul-help" class="mt-1.5 text-xs text-slate-400">Gunakan judul singkat yang menggambarkan masalah.</p>
                    @error('judul')
                        <p id="judul-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="detail" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Deskripsi Pengaduan <span class="text-rose-500">*</span>
                    </label>
                    <textarea
                        id="detail"
                        name="detail"
                        aria-describedby="detail-help detail-error"
                        @error('detail') aria-invalid="true" @enderror
                        wire:model="detail"
                        rows="6"
                        maxlength="10000"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white p-4 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none resize-y"
                    ></textarea>
                    <p id="detail-help" class="mt-1.5 text-xs text-slate-400">Jelaskan lokasi kejadian dalam deskripsi. Maksimal 10.000 karakter.</p>
                    @error('detail')
                        <p id="detail-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Tanggal Kejadian <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        aria-describedby="tanggal-error"
                        @error('tanggal') aria-invalid="true" @enderror
                        wire:model="tanggal"
                        max="{{ today()->format('Y-m-d') }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                    @error('tanggal')
                        <p id="tanggal-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Foto Bukti Saat Ini & Upload Baru --}}
                <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 p-5">
                    <label for="foto" class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Ganti Foto Bukti <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <p class="text-xs text-slate-400 mb-3">Biarkan kosong jika tidak ingin mengganti foto saat ini.</p>

                    @if($laporan->foto)
                        <div class="mb-4 rounded-xl border border-slate-200 bg-white p-3 inline-block">
                            <p class="text-[11px] font-bold text-slate-500 mb-1.5">Foto Saat Ini:</p>
                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Foto saat ini" class="h-28 rounded-lg object-contain">
                        </div>
                    @endif

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        aria-describedby="foto-help foto-error"
                        @error('foto') aria-invalid="true" @enderror
                        wire:model="foto"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full text-xs text-slate-500 file:mr-3 file:rounded-xl file:border-0 file:bg-emerald-600 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-white file:cursor-pointer hover:file:bg-emerald-700"
                    >

                    <div wire:loading wire:target="foto" class="mt-3 flex items-center gap-2 text-xs font-medium text-emerald-600">
                        <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                        <span>Sedang mengunggah gambar baru…</span>
                    </div>

                    @if ($foto && method_exists($foto, 'isPreviewable') && $foto->isPreviewable())
                        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50/60 p-3">
                            <p class="text-[11px] font-bold text-emerald-800 mb-2">Pratinjau Foto Baru:</p>
                            <img src="{{ $foto->temporaryUrl() }}" alt="Pratinjau Foto Baru" class="max-h-48 rounded-lg object-contain">
                        </div>
                    @endif

                    @error('foto')
                        <p id="foto-error" role="alert" class="mt-2 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a
                    href="{{ route('warga.laporan.show', $laporan) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                >
                    Batalkan
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="group inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition-all duration-150 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-600/35 active:scale-95 disabled:opacity-60"
                >
                    <span wire:loading.remove wire:target="save" class="inline-flex items-center gap-2">
                        <span>Simpan Perubahan</span>
                        <i data-lucide="check" class="h-4 w-4 transition group-hover:scale-110"></i>
                    </span>
                    <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
                        <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                        <span>Menyimpan…</span>
                    </span>
                </button>
            </div>
        </form>

        {{-- Side Note --}}
        <aside class="space-y-6">
            <div class="rounded-3xl border border-amber-200/80 bg-gradient-to-br from-amber-50/50 to-white p-6 text-xs text-amber-900 shadow-xs">
                <div class="flex items-center gap-2 font-bold text-amber-800">
                    <i data-lucide="alert-triangle" class="h-4 w-4"></i>
                    <span>Ketentuan Perubahan</span>
                </div>
                <p class="mt-2 text-[11px] leading-relaxed text-amber-800/90">
                    Pengaduan hanya bisa diubah selama statusnya <strong>Menunggu</strong>. Begitu petugas mengalihkan status menjadi <strong>Diproses</strong>, opsi perbaikan akan otomatis dinonaktifkan.
                </p>
            </div>
        </aside>
    </div>
</div>
