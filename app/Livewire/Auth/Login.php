<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate(['email' => 'required|email|max:255', 'password' => 'required|string|max:255']);
        $key = 'login:'.Str::transliterate(Str::lower($this->email)).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['email' => 'Terlalu banyak percobaan. Coba lagi dalam '.RateLimiter::availableIn($key).' detik.']);
        }
        if (! Auth::attempt(['email' => Str::lower(trim($this->email)), 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($key, 60);
            $this->reset('password');
            throw ValidationException::withMessages(['email' => 'Email atau password tidak sesuai.']);
        }
        RateLimiter::clear($key);
        session()->regenerate();
        $this->redirectRoute(auth()->user()->dashboardRoute());
    }

    public function render(): View
    {
        return view('livewire.auth.login')->title('Masuk');
    }
}