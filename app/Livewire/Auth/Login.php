<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;

class Login extends Component
{

    public ?string $email = null;
    public ?string $password = null;

    protected array $rules = [
        'email' => ['required', 'email', 'max:255', 'confirmed'],
        'password' => ['required'],
    ];

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.layouts.guest');
    }

    public function submit() 
    {

        $user = User::where('email', $this->email)->first();

        if($user) 
        {
            auth()->login($user);

            return redirect('/');

        } else {
            $this->addError('email', 'Email ou senha inválidos');
        }
    }
}
