<div>
    <div class="mb-8">
        <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold tracking-wider text-emerald-700 uppercase">
            MASUK PORTAL
        </span>
        <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Selamat Datang Kembali
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Masuk ke akun Anda untuk memantau atau membuat laporan pengaduan baru.
        </p>
    </div>

    <form wire:submit="login" class="space-y-4">
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
                    placeholder="nama@email.com"
                    autocomplete="email"
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
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Kata Sandi
                </label>
            </div>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i data-lucide="lock" class="h-4 w-4"></i>
                </span>
                <input
                    type="password"
                    id="password"
                    name="password"
                    aria-describedby="password-error"
                    @error('password') aria-invalid="true" @enderror
                    wire:model="password"
                    placeholder="Masukkan kata sandi"
                    autocomplete="current-password"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pr-4 pl-10 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none"
                >
            </div>
            @error('password')
                <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1.5">
                    <i data-lucide="alert-circle" class="h-3.5 w-3.5 shrink-0"></i>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div class="flex items-center justify-between py-1">
            <label class="flex items-center gap-2.5 text-xs font-medium text-slate-600 cursor-pointer select-none">
                <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded-md border-slate-300 text-emerald-600 accent-emerald-600 focus:ring-emerald-500">
                <span>Ingat saya di perangkat ini</span>
            </label>
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition-all duration-150 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-600/35 active:scale-[0.99] disabled:opacity-60"
        >
            <span wire:loading.remove wire:target="login" class="inline-flex items-center gap-2">
                <span>Masuk Sekarang</span>
                <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-0.5"></i>
            </span>
            <span wire:loading wire:target="login" class="inline-flex items-center gap-2">
                <i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i>
                <span>Memvalidasi kredensial…</span>
            </span>
        </button>
    </form>

    <div class="mt-8 rounded-xl border border-slate-100 bg-slate-50/80 p-4 text-center">
        <p class="text-xs text-slate-600">
            Belum memiliki akun warga?
            <a href="{{ route('register') }}" wire:navigate class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>
</div>
