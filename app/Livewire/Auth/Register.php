<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules;
use App\Notifications\WelcomeNotification;

class Register extends Component
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $email_confirmation = null;
    public ?string $password = null;

    protected array $rules = [
        'name' => ['required', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'confirmed', 'unique:users,email'],
        'email_confirmation' => ['required'],
        'password' => ['required'],
    ];

    public function render()
    {
        return view('livewire.auth.register')
              ->layout('components.layouts.guest');  //aqui está falando qual layout ele irá usar.
    }

    public function submit() 
    {
        // $this->validate();

        $verifyEmail = User::where('email', $this->email)->exists() ? $this->addError('email', 'Email já cadastrado') : null;

        if($verifyEmail == null)
        {
            $user = User::query()->create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            auth()->login($user);
    
            $user->notify(new WelcomeNotification);
            $this->redirect('/');
        }
        
    }
}
