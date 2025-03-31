
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
    
   {{ $users->links() }}
</div>
