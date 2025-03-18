<div class="flex justify-end mt-4">
    <x-drawer
        wire:model="showDrawer3"
        title="Hello"
        subtitle="Livewire"
        separator
        with-close-button
        close-on-escape
        right
        class="w-11/12 lg:w-1/3"
    >
        <div>Hey!</div>
            
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.showDrawer3 = false" />
            <x-button label="Confirm" class="btn-primary" icon="o-check" />
        </x-slot:actions>
    </x-drawer>
            
         <x-button icon="o-plus" class="btn-primary" @click="$wire.showDrawer3 = true" />
     
</div>