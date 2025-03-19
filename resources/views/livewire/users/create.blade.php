@php 
 $permissions = ['Admin', 'User'];
@endphp

<div class="flex justify-end m-4">
    <x-drawer
        wire:model="showDrawer3"
        title="Cadastro de cliente"
        subtitle="Preencha os dados do cliente abaixo"
        separator
        with-close-button
        close-on-escape
        right
        class="w-11/12 lg:w-1/3"
    >
        

        {{-- formulário de criação do cliente --}}
        <x-form wire:submit="create">
            <x-input label="Nome" wire:model="name" />
            <x-input label="Email" wire:model.live="email" />
            <x-input label="Idade" type="number" wire:model="age" />
            <x-select
                label="Permissão"
                :options="collect($permissions)->map(fn($permission) => ['custom_key' => $permission, 'other_name' => $permission])->toArray()"
                option-value="custom_key"
                option-label="other_name"
                placeholder="Selecionar permissão"
                placeholder-value="0" {{-- Set a value for placeholder. Default is `null` --}}
                hint="Select one, please."
                wire:model="work" />

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.showDrawer3 = false" />
                <x-button type="submit" label="Confirm" class="btn-primary" icon="o-check" spinner="create"/>
            </x-slot:actions>

        </x-form>
    </x-drawer>
            

    <x-button icon="o-plus" class="btn-primary" @click="$wire.showDrawer3 = true" />

     
</div>