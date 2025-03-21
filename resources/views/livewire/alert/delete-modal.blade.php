<div>
    <x-modal wire:model="myModal2" title="{{ $title }}">
        <div class="text-start">
            {{ $description }}
        </div>
    
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.myModal2 = false" />
            <x-button :label="$label" wire:click="{{$function}}({{$client['id']}})" class="btn-error"  spinner/>
        </x-slot:actions>
    </x-modal>

    <x-button  icon="o-{{ $icon }}"  @click="$wire.myModal2 = true" spinner class="btn-ghost btn-sm text-{{ $colorIcon }}-500" tooltip="{{ $tooltip }}"/>
 
</div>
