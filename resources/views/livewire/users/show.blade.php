
<div>
    <!-- HEADER -->
    <x-header title="Lista de Usuários" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>



    <livewire:clients.create :icon="'o-plus'" :class="'btn-primary'" />
    
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
                <x-button 
                    id="impersonate-btn-{{ $user->id }}"
                    key="impersonate-btn-{{ $user->id }}"
                    icon="o-eye" 
                    @click="$dispatch('user::impersonate', { id: {{ $user->id }} })"
                    class="btn-ghost btn-sm" />
                
                <x-button icon="o-pencil-square" class="btn-ghost btn-sm" />

                <x-button icon="o-archive-box-arrow-down" class="btn-ghost btn-sm text-green-500" />

                <x-button icon="o-trash" class="btn-ghost btn-sm text-red-500" />
            </div>
        @endscope

        </x-table>
    </x-card>

   <div>
    @foreach ($formInputs as $index => $form)
        <div class="mb-4 border p-4 rounded shadow">
            <x-choices
                label="Searchable + Single"
                wire:model.live="formInputs.{{ $index }}.name"
                :options="$books"
                option-value="value"
                option-name="name"
                placeholder="Search ..."
                single
                searchable />

        <p>
            @foreach($books as $book)
                {{ $book['value'] ?? '' }}@if(!$loop->last), @endif
            @endforeach
        </p>
            <button wire:click="removeForm({{ $index }})" class="text-red-500 mt-2">Remover</button>
        </div>
    @endforeach

    <button wire:click="addForm" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar formulário</button>

    <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Salvar todos</button>

    @if (session()->has('success'))
        <div class="text-green-600 mt-4">
            {{ session('success') }}
        </div>
    @endif
</div>


    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
    
   {{ $users->links() }}

   <livewire:admin.users.impersonate />
</div>
