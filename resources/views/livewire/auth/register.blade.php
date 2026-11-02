<div>
    <div class="mb-6">
        <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold tracking-wider text-emerald-700 uppercase">
            REGISTRASI WARGA
        </span>
        <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Buat Akun Warga
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Daftarkan diri Anda untuk menyuarakan aspirasi dan memantau penanganan pengaduan.
        </p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label for="name" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                Nama Lengkap
            </label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i data-lucide="user" class="h-4 w-4"></i>
                </span>
                <input
                    type="text"
                    id="name"
                    name="name"
                    aria-describedby="name-error"
                    @error('name') aria-invalid="true" @enderror
                    wire:model="name"
                    autocomplete="name"
                    placeholder="Nama lengkap sesuai KTP"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                >
            </div>
            @error('name')
                <p id="name-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                    <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="email" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-lucide="mail" class="h-4 w-4"></i>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        aria-describedby="email-error"
                        @error('email') aria-invalid="true" @enderror
                        wire:model="email"
                        autocomplete="email"
                        placeholder="nama@email.com"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                </div>
                @error('email')
                    <p id="email-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                        <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div>
                <label for="no_whatsapp" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Nomor WhatsApp
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-lucide="phone" class="h-4 w-4"></i>
                    </span>
                    <input
                        type="tel"
                        id="no_whatsapp"
                        name="no_whatsapp"
                        aria-describedby="no_whatsapp-error"
                        @error('no_whatsapp') aria-invalid="true" @enderror
                        wire:model="no_whatsapp"
                        autocomplete="tel"
                        placeholder="08xxxxxxxxxx"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                </div>
                @error('no_whatsapp')
                    <p id="no_whatsapp-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                        <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>
        </div>

        <div>
            <label for="alamat" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                Alamat Domisili
            </label>
            <div class="relative">
                <textarea
                    id="alamat"
                    name="alamat"
                    aria-describedby="alamat-error"
                    @error('alamat') aria-invalid="true" @enderror
                    wire:model="alamat"
                    autocomplete="street-address"
                    placeholder="Contoh: Jl. Mawar No. 12, RT 02 / RW 04, Kelurahan..."
                    rows="3"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white p-3 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none resize-none"
                ></textarea>
            </div>
            @error('alamat')
                <p id="alamat-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                    <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Kata Sandi
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-lucide="lock" class="h-4 w-4"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        aria-describedby="password-help password-error"
                        @error('password') aria-invalid="true" @enderror
                        wire:model="password"
                        autocomplete="new-password"
                        placeholder="Min. 8 karakter"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                </div>
                <p id="password-help" class="mt-1 text-[11px] text-slate-400">Gunakan kombinasi huruf, angka, dan simbol.</p>
                @error('password')
                    <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                        <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Konfirmasi Sandi
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-lucide="shield" class="h-4 w-4"></i>
                    </span>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        wire:model="password_confirmation"
                        autocomplete="new-password"
                        placeholder="Ulangi kata sandi"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                    >
                </div>
            </div>
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="group mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition-all duration-150 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-600/35 active:scale-[0.99] disabled:opacity-60"
        >
            <span wire:loading.remove wire:target="register" class="inline-flex items-center gap-2">
                <span>Daftar Akun Warga</span>
                <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-0.5"></i>
            </span>
            <span wire:loading wire:target="register" class="inline-flex items-center gap-2">
                <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                <span>Menyiapkan akun…</span>
            </span>
        </button>
    </form>

    <div class="mt-6 rounded-xl border border-slate-100 bg-slate-50/80 p-4 text-center">
        <p class="text-xs text-slate-600">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" wire:navigate class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline">
                Masuk di sini
            </a>
        </p>
    </div>
</div>
