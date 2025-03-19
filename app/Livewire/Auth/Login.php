<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class Login extends Component
{

    public ?string $email = null;
    public ?string $password = null;

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.layouts.guest');
    }

    public function submit() 
    {
        if($this->ensureIsNotRateLimiting()) {
            return;
        }

        // Verifica se o usuário existe
        if(!Auth::attempt(['email' => $this->email, 'password' => $this->password])) 
        {
            RateLimiter::hit($this->throttleKey());

            $this->addError('InvalidCredentials', trans('auth.failed'));

            return;

        } 

        session()->flash('success', 'Login efetuado com sucesso!');

        $this->redirect('/');
    }

    private function throttleKey(): string
    {
        //tr::translirerate() irá converter qualquer caracter especial em um caracter comum
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    private function ensureIsNotRateLimiting(): bool
    {
        // Verifica se o usuário tentou logar mais de 5 vezes
        if (RateLimiter::tooManyAttempts($this->email, 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->email),
            ]));

            return true;
        }

        return false;
    }
}
