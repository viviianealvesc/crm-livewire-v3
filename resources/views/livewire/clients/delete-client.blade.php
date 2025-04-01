<div>

    <!-- HEADER -->
    <x-header title="Clientes Excluidos" separator progress-indicator>
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
            @can('be an admin')
                @scope('actions', $deletedClient)
                <div class="flex space-x-1">
                    <livewire:alert.delete-modal :title="'Excluir Cliente'" 
                                    :description="'Deseja mesmo excluir este cliente?'" 
                                    :client="$deletedClient" :icon="'trash'" :colorIcon="'red'" :tooltip="'Excluir'" :label="'Excluir'"
                                    :function="'deletePermanently'" spinner/>
                    
                    <livewire:alert.delete-modal :title="'Restaurar Cliente'" 
                                    :description="'Deseja mesmo restaurar este cliente?'" 
                                    :client="$deletedClient" :icon="'cloud-arrow-up'" :colorIcon="'green'" :tooltip="'Restaurar'" :label="'Restaurar'"
                                    :function="'restore'" spinner/>
                </div>
                @endscope
            @endcan
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
