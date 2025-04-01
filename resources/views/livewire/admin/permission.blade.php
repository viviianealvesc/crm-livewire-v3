<div>

    <!-- HEADER -->
    <x-header title="Permissões" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>
    <!-- TABLE  -->
    <x-card wire:loading.remove>
        <x-table :headers="$headers" :rows="$permissions">
        @scope('actions', $permission)
             <x-button
                 id="update-btn-{{ $permission->id }}"
                 wire:key="update-btn-{{ $permission->id }}"
                 icon="o-plus"
                 @click="$dispatch('permission::create', { id: {{ $permission->id }}})"
                 spinner class="!border-gray-400 btn-outline">
             </x-button>
        @endscope
       
        </x-table>
    </x-card>

</div>
