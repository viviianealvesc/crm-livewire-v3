<div class="flex p-2 gap-2 items-center font-semibold bg-primary text-neutral">
    <p>Você está se passando por 
        <strong>{{ $user->name }}</strong>,
        <button wire:click="stopImpersonate" class="underline hover:text-neutral/80 duration-500">clique aqui</button>
         para parar de se passar por ele.</p>
</div>
