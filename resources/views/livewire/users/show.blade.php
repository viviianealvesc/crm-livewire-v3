
<div>
    <!-- HEADER -->
    <x-header title="Lista de Usuários" separator progress-indicator>   
    </x-header>

    <div class="grid grid-cols-3 gap-4 items-center">
        <x-input placeholder="Search..." wire:model.live.debounce.500ms="search" clearable icon="o-magnifying-glass" />

        <x-choices class="select-xs" placeholder="Filter by permission" wire:model.live="search_permissions"
                   :options="$permissionsToSearch" option-label="key" 
                   searchable no-result-text="No results found" />

        <livewire:clients.create :icon="'o-plus'" :class="'btn-primary'" />
    </div>
  

    <!-- TABLE  -->
    <x-card wire:loading.remove>

        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy" with-pagination>        
        
        @scope('cell_permission', $user)
            @foreach($user->permissions as $permission)
                <x-badge :value="$permission->key" class="badge-warning"/>
            @endforeach
        @endscope

        @scope('actions', $user)
            <div class="flex items-center space-x-1">
                <x-button icon="o-pencil-square" class="btn-ghost btn-sm flex items-center justify-center" />

                <x-button icon="o-archive-box-arrow-down" class="btn-ghost btn-sm flex items-center justify-center text-green-500" />

                <x-button icon="o-trash" class="btn-ghost btn-sm flex items-center justify-center text-red-500" />
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
    
   {{ $users->links() }}
</div>
