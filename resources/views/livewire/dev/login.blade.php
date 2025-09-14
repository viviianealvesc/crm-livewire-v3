<div class="flex items-centter p-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white space-x-2 justify-end">
    <div class="mr-2 flex items-center space-x-2">
        <livewire:branch-env />

        <x-select 
            wire:model="selectedUser" 
            :options="$this->users" 
            placeholder="Selecione um usuário" 
            option-value="id" 
            option-name="name" 
        />
    </div>


    <x-button wire:click="login" label="Login" />

</div>
