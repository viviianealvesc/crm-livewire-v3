<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Collection;

class DeleteClient extends Component
{
    public string $search = '';

    public bool $drawer = false;
    
    public bool $myModal12 = false;

    public $deletedClients;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

       // Table headers
       public function headers(): array
       {
           return [
               ['key' => 'id', 'label' => '#'],
               ['key' => 'name', 'label' => 'Name'],
               ['key' => 'age', 'label' => 'Idade'],
               ['key' => 'email', 'label' => 'E-mail'],
               ['key' => 'work', 'label' => 'Profissão'],
           ];
       }

    public function clients(): Collection
    {
        $this->deletedClients = Client::onlyTrashed()->get();
        
       return $this->deletedClients
            ->sortBy($this->sortBy['column'], SORT_REGULAR, $this->sortBy['direction'] === 'desc')
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn($item) => str($item->name)->contains($this->search, true));
            });
    }

    public function with(): array
    {
        return [
            'deletedClients' => $this->deletedClients(),
            'headers' => $this->headers()
        ];
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->restore();
        
        session()->flash('message', 'Cliente restaurado com sucesso!');
    }

    public function deletePermanently($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->forceDelete();

        session()->flash('message', 'Cliente excluído permanentemente!');
    }

    public function render()
    {
        $this->deletedClients = Client::onlyTrashed()->get();

        return view('livewire.clients.delete-client', [
            'deletedClients' => $this->deletedClients,
            'headers' => $this->headers()
        ]);
    }
}
