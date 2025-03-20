<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Client;

new class extends Component {
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    
    public bool $myModal12 = false;

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
               ['key' => 'age', 'label' => 'Age'],
               ['key' => 'email', 'label' => 'E-mail'],
               ['key' => 'work', 'label' => 'Profissão'],
           ];
       }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function clients(): Collection
    {
        $clients = Client::all();

        return $clients
            ->sortBy($this->sortBy['column'], SORT_REGULAR, $this->sortBy['direction'] === 'desc')
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn($item) => str($item->name)->contains($this->search, true));
            });
    }

    public function with(): array
    {
        return [
            'clients' => $this->clients(),
            'headers' => $this->headers()
        ];
    }
}; ?>

<div>
    <!-- HEADER -->
    <x-header title="Lista de Clientes" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>


    <livewire:clients.create />
    
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$clients" :sort-by="$sortBy">
            @scope('actions', $client)
            <div class="flex space-x-1">
                <livewire:alert.delete-modal :title="'Excluir Cliente'" 
                                :description="'Deseja mesmo excluir este cliente?'" 
                                :client="$client" :icon="'trash'" :colorIcon="'red'" :tooltip="'Excluir'" :label="'Excluir'"
                                :function="'delete'"/>
                <livewire:alert.delete-modal :title="'Arquivar Cliente'" 
                                :description="'Deseja mesmo arquivar este cliente?'" 
                                :client="$client" :icon="'archive-box-arrow-down'" :colorIcon="'green'" :tooltip="'Arquivar'" :label="'Arquivar'"
                                :function="'ClintArchived'"/>
            </div>
            @endscope
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
