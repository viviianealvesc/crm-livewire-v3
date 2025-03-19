<div>
    <x-modal wire:model="myModal2" title="Hello" subtitle="Livewire example" separator>
        <div>Hey!</div>
    
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.myModal2 = false" />
            <x-button label="Confirm" class="btn-primary" />
        </x-slot:actions>
        <x-button label="deletar" wire:click="delete({{ $user['id'] }})"  spinner class="btn-ghost btn-sm text-red-500" />
    </x-modal>

    <x-button  icon="o-trash"  @click="$wire.myModal2 = true" spinner class="btn-ghost btn-sm text-red-500"/>
 
</div>
