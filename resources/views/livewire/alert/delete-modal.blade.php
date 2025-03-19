<div>
    <x-modal wire:model="myModal2" title="Deletar cliente">
        <div class="text-start">
            Deseja mesmo deletar {{ $user->name }}?
        </div>
    
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.myModal2 = false" />
            <x-button label="Deletar" wire:click="delete({{ $user['id'] }})" class="btn-error"  spinner/>
        </x-slot:actions>
    </x-modal>

    <x-button  icon="o-trash"  @click="$wire.myModal2 = true" spinner class="btn-ghost btn-sm text-red-500"/>
 
</div>
