<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('warga.laporan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-emerald-600 transition">
                <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
                <span>Kembali ke Daftar Pengaduan</span>
            </a>
            <h1 class="mt-2 font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                Buat Pengaduan Baru
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Sampaikan permasalahan lingkungan dengan detail yang jelas agar petugas dapat menindaklanjuti secara akurat.
            </p>
        </div>
    </div>

    {{-- 2-Column Grid --}}
    <div class="grid items-start gap-8 lg:grid-cols-[1fr_340px]">
        {{-- Main Form Card --}}
        <form wire:submit="save" method="POST" action="#" class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-xs">
            @csrf
            <div class="mb-6 border-b border-slate-100 pb-4">
                <h2 class="font-display text-lg font-bold text-slate-900">Formulir Laporan Warga</h2>
                <p class="text-xs text-slate-400">Pastikan seluruh data yang dimasukkan benar dan dapat dipertanggungjawabkan.</p>
            </div>

            <div class="space-y-6">
                {{-- Judul Pengaduan --}}
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
                        placeholder="Contoh: Lampu penerangan jalan padam di Jl. Anggrek RT 02"
                        maxlength="255"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                    <p id="judul-help" class="mt-1.5 text-xs text-slate-400">Tuliskan ringkasan masalah dan nama lokasi secara singkat.</p>
                    @error('judul')
                        <p id="judul-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi Pengaduan --}}
                <div>
                    <label for="detail" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Deskripsi Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <textarea
                        id="detail"
                        name="detail"
                        aria-describedby="detail-help detail-error"
                        @error('detail') aria-invalid="true" @enderror
                        wire:model="detail"
                        rows="6"
                        placeholder="Ceritakan kronologi masalah secara jelas: titik patokan lokasi, sejak kapan masalah terjadi, dan dampaknya bagi warga sekitar…"
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

                {{-- Tanggal Kejadian --}}
                <div>
                    <label for="tanggal" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Tanggal Kejadian <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
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
                    </div>
                    @error('tanggal')
                        <p id="tanggal-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Upload Foto Bukti --}}
                <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 p-5 transition hover:border-emerald-300">
                    <label for="foto" class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Foto Bukti Kejadian <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <p class="text-xs text-slate-400 mb-3">Format berkas: JPG, JPEG, PNG, atau WebP (Maksimal 2 MB).</p>

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

                    {{-- Loading Status --}}
                    <div wire:loading wire:target="foto" class="mt-3 flex items-center gap-2 text-xs font-medium text-emerald-600">
                        <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                        <span>Sedang mengunggah dan memverifikasi gambar…</span>
                    </div>

                    {{-- Live Preview --}}
                    @if ($foto && method_exists($foto, 'isPreviewable') && $foto->isPreviewable())
                        <div class="mt-4 rounded-xl border border-emerald-200 bg-white p-3">
                            <p class="text-[11px] font-bold text-emerald-800 mb-2">Pratinjau Foto Terpilih:</p>
                            <img src="{{ $foto->temporaryUrl() }}" alt="Pratinjau Foto" class="max-h-48 rounded-lg object-contain">
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
                    href="{{ route('warga.laporan.index') }}"
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
                        <span>Kirim Pengaduan</span>
                        <i data-lucide="send" class="h-4 w-4 transition group-hover:translate-x-0.5"></i>
                    </span>
                    <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
                        <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                        <span>Menyimpan Laporan…</span>
                    </span>
                </button>
            </div>
        </form>

        {{-- Side Guidelines Panel --}}
        <aside class="space-y-6">
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-xs">
                <div class="flex items-center gap-2.5 text-emerald-800">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <i data-lucide="lightbulb" class="h-4 w-4"></i>
                    </span>
                    <h3 class="font-display text-sm font-bold">Tips Laporan Efektif</h3>
                </div>

                <ul class="mt-4 space-y-3 text-xs leading-relaxed text-slate-600">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="h-4 w-4 text-emerald-600 shrink-0 mt-0.5"></i>
                        <span><strong>Sertakan patokan lokasi</strong> (contoh: di depan nomor rumah, dekat gapura RT).</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="h-4 w-4 text-emerald-600 shrink-0 mt-0.5"></i>
                        <span><strong>Lampirkan foto jelas</strong> pada siang hari atau pencahayaan cukup.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="h-4 w-4 text-emerald-600 shrink-0 mt-0.5"></i>
                        <span><strong>Gunakan bahasa santun</strong> dan fokus pada fakta kejadian.</span>
                    </li>
                </ul>
            </div>

            <div class="rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-50/70 to-teal-50/50 p-6 text-xs text-emerald-900">
                <div class="flex items-center gap-2 font-bold">
                    <i data-lucide="shield-check" class="h-4 w-4 text-emerald-700"></i>
                    <span>Hak & Keamanan Anda</span>
                </div>
                <p class="mt-2 text-[11px] leading-relaxed text-emerald-800">
                    Laporan ini dapat Anda edit atau hapus selama statusnya masih <strong>Menunggu</strong>. Begitu ditangani petugas, isi laporan akan dibekukan agar audit penanganan valid.
                </p>
            </div>
        </aside>
    </div>
</div>
