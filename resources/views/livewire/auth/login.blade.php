<x-card title="Login" shadow class="mx-auto w-[400px]">   

    @if($errors->hasAny(['InvalidCredentials', 'rateLimiter']))
        <x-alert icon="o-exclamation-triangle" class="alert-warning text-xs my-4">
            @error('InvalidCredentials')
                {{ $message }}
            @enderror
        
            @error('rateLimiter')
                {{ $message }}
            @enderror
        </x-alert>
    @endif

    <x-form wire:submit="submit">
        <x-input label="Email" wire:model="email" />
        <x-input label="Senha" type="password" wire:model="password" />
    
        <x-slot:actions>
            <x-button label="Reset" type="reset"/>
            <x-button label="Logar" class="btn-primary" type="submit" spinner="submit"/>
        </x-slot:actions>
    </x-form>
</x-card>


