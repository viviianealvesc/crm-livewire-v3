<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Collection;

class ArchivedClient extends Component
{
    public string $search = '';

    public bool $drawer = false;
    
    public bool $myModal12 = false;

    public $deletedClients;

    public $client;

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
        $client = Client::whereNotNull('archived_at')->find($id);
        $client->restoreArchive(); // Cliente ativo novamente
        
        session()->flash('message', 'Cliente restaurado com sucesso!');
    }

    public function render()
    {
        $archivedClients = Client::whereNotNull('archived_at')->get();

        return view('livewire.clients.archived-client', [
            'archivedClients' => $archivedClients,
            'headers' => $this->headers()
        ]);
    }

}
