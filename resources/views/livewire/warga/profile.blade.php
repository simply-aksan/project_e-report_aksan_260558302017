<div class="space-y-6">
    {{-- Header --}}
    <div>
        <div class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 uppercase tracking-wider">
            <span>PENGATURAN AKUN</span>
        </div>
        <h1 class="mt-1 font-display text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            Profil & Keamanan Akun
        </h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Kelola data identitas warga, kontak WhatsApp, dan perbarui kata sandi Anda.
        </p>
    </div>

    {{-- Success Flash Notification --}}
    @if(session('success'))
        <div role="status" class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/90 p-4 text-sm font-medium text-emerald-900 shadow-xs">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
                <i data-lucide="check" class="h-4 w-4"></i>
            </span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Main Grid --}}
    <div class="grid items-start gap-8 lg:grid-cols-[300px_1fr]">
        {{-- Profile Summary Card --}}
        <aside class="rounded-3xl border border-slate-200/90 bg-white p-6 text-center shadow-xs">
            <div class="relative mx-auto h-24 w-24">
                @if(auth()->user()->foto)
                    <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil Anda" class="h-24 w-24 rounded-3xl object-cover ring-4 ring-emerald-500/20 shadow-md">
                @else
                    <div class="flex h-24 w-24 items-center justify-center rounded-3xl bg-gradient-to-tr from-emerald-600 to-teal-500 font-display text-3xl font-extrabold text-white shadow-md">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                <span class="absolute -bottom-1 -right-1 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-white ring-2 ring-white">
                    <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                </span>
            </div>

            <h2 class="mt-4 font-display font-bold text-slate-900 text-lg break-words">
                {{ auth()->user()->name }}
            </h2>
            <p class="text-xs text-slate-400 break-words mt-0.5">{{ auth()->user()->email }}</p>

            <div class="mt-3">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Warga Terverifikasi
                </span>
            </div>

            <dl class="mt-6 space-y-3.5 border-t border-slate-100 pt-5 text-left text-xs">
                <div>
                    <dt class="font-bold text-slate-400 uppercase tracking-wider text-[10px]">Nomor WhatsApp</dt>
                    <dd class="mt-1 font-semibold text-slate-700 flex items-center gap-2">
                        <i data-lucide="phone" class="h-3.5 w-3.5 text-emerald-600"></i>
                        <span>{{ auth()->user()->no_whatsapp ?: 'Belum diisi' }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="font-bold text-slate-400 uppercase tracking-wider text-[10px]">Alamat Domisili</dt>
                    <dd class="mt-1 leading-relaxed text-slate-600 break-words flex items-start gap-2">
                        <i data-lucide="map-pin" class="h-3.5 w-3.5 text-emerald-600 shrink-0 mt-0.5"></i>
                        <span>{{ auth()->user()->alamat ?: 'Belum diisi' }}</span>
                    </dd>
                </div>
            </dl>
        </aside>

        {{-- Form Sections (Profile & Password) --}}
        <div class="space-y-8">
            {{-- Form 1: Edit Profile --}}
            <form wire:submit="updateProfile" class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-xs">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="font-display text-lg font-bold text-slate-900">Informasi Pribadi</h2>
                    <p class="text-xs text-slate-400">Pastikan nomor WhatsApp dan alamat domisili selalu mutakhir agar mudah dihubungi saat tindak lanjut lapangan.</p>
                </div>

                <div class="mt-6 space-y-5">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            aria-describedby="name-error"
                            @error('name') aria-invalid="true" @enderror
                            wire:model="name"
                            autocomplete="name"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                        >
                        @error('name')
                            <p id="name-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    {{-- Email (Read-Only) --}}
                    <div>
                        <label for="email" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Alamat Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            aria-describedby="email-help email-error"
                            @error('email') aria-invalid="true" @enderror
                            value="{{ auth()->user()->email }}"
                            readonly
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 cursor-not-allowed select-none"
                        >
                        <p id="email-help" class="mt-1.5 text-xs text-slate-400">Alamat email digunakan sebagai pengenal akun permanen dan tidak dapat diubah.</p>
                        @error('email')
                            <p id="email-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No WhatsApp --}}
                    <div>
                        <label for="no_whatsapp" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Nomor WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="tel"
                            id="no_whatsapp"
                            name="no_whatsapp"
                            aria-describedby="no_whatsapp-error"
                            @error('no_whatsapp') aria-invalid="true" @enderror
                            wire:model="no_whatsapp"
                            autocomplete="tel"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                        >
                        @error('no_whatsapp')
                            <p id="no_whatsapp-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="alamat" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Alamat Domisili <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            aria-describedby="alamat-error"
                            @error('alamat') aria-invalid="true" @enderror
                            wire:model="alamat"
                            autocomplete="street-address"
                            rows="3"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white p-4 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none resize-none"
                        ></textarea>
                        @error('alamat')
                            <p id="alamat-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    {{-- Foto Profil --}}
                    <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 p-5">
                        <label for="foto" class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Perbarui Foto Profil
                        </label>
                        <p class="text-xs text-slate-400 mb-3">Format: JPG, PNG, atau WebP (Maks. 2 MB).</p>

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

                        <div wire:loading wire:target="foto" class="mt-2 text-xs text-emerald-600 flex items-center gap-2">
                            <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                            <span>Memproses unggahan foto…</span>
                        </div>

                        @error('foto')
                            <p id="foto-error" role="alert" class="mt-2 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end border-t border-slate-100 pt-6">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition hover:bg-emerald-700 active:scale-95 disabled:opacity-60"
                    >
                        <span wire:loading.remove wire:target="updateProfile" class="inline-flex items-center gap-2">
                            <span>Simpan Informasi Profil</span>
                            <i data-lucide="check" class="h-4 w-4"></i>
                        </span>
                        <span wire:loading wire:target="updateProfile" class="inline-flex items-center gap-2">
                            <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                            <span>Menyimpan…</span>
                        </span>
                    </button>
                </div>
            </form>

            {{-- Form 2: Update Password --}}
            <form wire:submit="updatePassword" class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-xs">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="font-display text-lg font-bold text-slate-900">Ubah Kata Sandi</h2>
                    <p class="text-xs text-slate-400">Gunakan kata sandi yang kuat dan unik untuk melindungi akun Anda.</p>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <label for="current_password" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Kata Sandi Saat Ini <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            aria-describedby="current_password-error"
                            @error('current_password') aria-invalid="true" @enderror
                            wire:model="current_password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                        >
                        @error('current_password')
                            <p id="current_password-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="new_password" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Kata Sandi Baru <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="password"
                                id="new_password"
                                name="password"
                                aria-describedby="password-error"
                                @error('password') aria-invalid="true" @enderror
                                wire:model="password"
                                autocomplete="new-password"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                            >
                            @error('password')
                                <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                                    <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Konfirmasi Sandi Baru <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                wire:model="password_confirmation"
                                autocomplete="new-password"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                            >
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end border-t border-slate-100 pt-6">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md transition hover:bg-slate-800 active:scale-95 disabled:opacity-60"
                    >
                        <span wire:loading.remove wire:target="updatePassword" class="inline-flex items-center gap-2">
                            <span>Perbarui Kata Sandi</span>
                            <i data-lucide="key" class="h-4 w-4"></i>
                        </span>
                        <span wire:loading wire:target="updatePassword" class="inline-flex items-center gap-2">
                            <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                            <span>Memperbarui…</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
