<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;

class Create extends Component
{
    public string $name = '';
    public string $email = '';
    public int $age = 0;
    public string $work = '';

    public $class = '';
    public $icon = '';

    public bool $showDrawer3 = false;

    protected array $rules = [
        'name' => ['required', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
        'age' => ['required', 'integer'],
        'work' => ['required', 'string'],
    ];

    public function render()
    {
        return view('livewire.clients.create');
    }

    public function create()
    {
        $this->validate();
        
        $client = Client::create([
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'work' => $this->work,
        ]);

        $this->reset(['name', 'email', 'age', 'work']);

        $this->dispatch('refreshTable');

        $this->showDrawer3 = false;
        
        $this->success('Cliente criado com sucesso.', position: 'toast-bottom');
    }
}
