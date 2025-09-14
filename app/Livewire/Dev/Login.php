<?php

namespace App\Livewire\Dev;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use App\Models\User;

class Login extends Component
{
    public ?int $selectedUser = null;

    public function render()
    {
        return view('livewire.dev.login');
    }

    #[Computed]
    public function users(): Collection
    {
        return User::all();
    }

    public function login()
    {
        auth()->loginUsingId($this->selectedUser);
        $this->redirect('/');
    }
}
