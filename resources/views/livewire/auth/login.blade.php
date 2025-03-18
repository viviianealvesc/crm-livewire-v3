<x-card shadow class="mx-auto w-[400px]">   
    <x-form wire:submit="submit">
        <x-input label="Email" wire:model="email" />
        <x-input label="Senha" type="password" wire:model="password" />
    
        <x-slot:actions>
            <x-button label="Reset" type="reset"/>
            <x-button label="Logar" class="btn-primary" type="submit" spinner="submit"/>
        </x-slot:actions>
    </x-form>
</x-card>
