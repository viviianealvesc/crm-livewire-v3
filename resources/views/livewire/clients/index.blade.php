<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Client;
use Livewire\WithPagination; 
use Illuminate\Pagination\LengthAwarePaginator; 

new class extends Component {

    use WithPagination; 
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    
    public bool $myModal12 = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    protected $listeners = ['refreshTable' => 'clients'];

    public bool $search_trash = false;

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
       

    public function clients(): LengthAwarePaginator 
    {
        sleep(0.5);
        return Client::query()
            ->whereNull('archived_at')
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->when($this->search_trash, fn(Builder $q) => $q->onlyTrashed())
            ->orderBy('created_at', 'desc')
            ->paginate(5);
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
        <x-slot:middle class="!justify-end !flex">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>
    
    
    
    <x-checkbox label="Usuários deletados" wire:model.live="search_trash" />
    <livewire:clients.create :icon="'o-plus'" :class="'btn-primary'" />

    @php 
     /** @var \App\Models\Clients $custumers */
    @endphp
    
    <!-- TABLE  -->
    <x-card wire:loading.remove>
        <x-table :headers="$headers" :rows="$clients" :sort-by="$sortBy" with-pagination>
            @scope('header_name', $header)
                {{ $header['label'] }} 🐾
            @endscope
            
            @scope('actions', $client)
            <div class="flex items-center space-x-1">
                <livewire:clients.create :icon="'o-pencil-square'" :class="'btn-ghost btn-sm flex items-center justify-center'" :client="$client ?? '' "/>

                <livewire:alert.delete-modal :title="'Arquivar Cliente'" 
                                :description="'Deseja mesmo arquivar este cliente?'" 
                                :client="$client" :icon="'archive-box-arrow-down'" :colorIcon="'green'" :tooltip="'Arquivar'" :label="'Arquivar'"
                                :function="'ClintArchived'"/>

                @unless($client->trashed())
                <livewire:alert.delete-modal :title="'Excluir Cliente'" 
                                :description="'Deseja mesmo excluir este cliente?'" 
                                :client="$client" :icon="'trash'" :colorIcon="'red'" :tooltip="'Excluir'" :label="'Excluir'"
                                :function="'delete'"/>
                @else
                <livewire:alert.delete-modal :title="'Desarquivar Cliente'" 
                                :description="'Deseja mesmo desarquivar este cliente?'" 
                                :client="$client" :icon="'cloud-arrow-up'" :colorIcon="'green'" :tooltip="'Desarquivar'" :label="'Desarquivar'"
                                :function="'restores'" spinner/>
                @endunless
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
