<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public string $name = '';
    
    public string $email = '';

    public int $age = 0;

    public string $work = '';

    public $class = '';

    public $icon = '';

    public $client;

    public bool $showDrawer3 = false;

    protected array $rules = [
        'name' => ['required', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
        'age' => ['required', 'integer'],
        'work' => ['required', 'string'],
    ];

    public function mount($client = null)
    {
        if ($client) {
            $this->client = $client;
            $this->name = $client->name;
            $this->email = $client->email;
            $this->age = $client->age;
            $this->work = $client->work;
        }
    }


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

    public function update()
    {
        $this->client->update([
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'work' => $this->work,
        ]);

        $this->reset(['name', 'email', 'age', 'work']);

        $this->dispatch('refreshTable');

        $this->showDrawer3 = false;

        $this->success('Cliente atualizado com sucesso.', position: 'toast-bottom');
    }   
}
