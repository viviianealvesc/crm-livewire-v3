<x-card shadow class="mx-auto w-[400px]">   
    <x-form wire:submit="submit">
        <x-input label="Name" wire:model="name" />
        <x-input label="Email" wire:model="email" />
        <x-input label="Confirmar seu email" wire:model="email_confirmation" />
        <x-input label="Senha" type="password" wire:model="password" />
    
        <x-slot:actions>
            <x-button label="Reset" type="reset"/>
            <x-button label="Registrar" class="btn-primary" type="submit" spinner="submit"/>
            <x-button label="Já tenho uma conta" class="btn-primary" link="/login" spinner/>
        </x-slot:actions>
    </x-form>
</x-card>
