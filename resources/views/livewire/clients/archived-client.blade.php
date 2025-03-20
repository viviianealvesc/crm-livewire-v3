<div>

    <!-- HEADER -->
    <x-header title="Clientes Arquivados" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>
    
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$deletedClients" :sort-by="$sortBy">
            @scope('actions', $deletedClient)
            <livewire:alert.delete-modal :client="$deletedClient"/>cloud-arrow-up
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

    @if (session()->has('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 5000)" 
            class="fixed top-4 right-4 z-50"
        >
            <x-alert type="success" icon="o-home" class="alert-warning" dismissible>
                {{ session('success') }}
            </x-alert>
        </div>
    @endif

</div>
