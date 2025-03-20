<div>
    <div class="flex flex-col sm:flex-row sm:space-x-4 sm:space-y-0 space-y-4 justify-center">
        <div class="sm:w-32 md:w-48 lg:w-64 ">
            <x-stat
                title="Sales"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-up"
                tooltip-bottom="There" responsive/>
        </div>
    
        <div class="sm:w-32 md:w-48 lg:w-64 ">
            <x-stat
                title="Lost"
                description="This month"
                value="34"
                icon="o-arrow-trending-down"
                tooltip-left="Ops!" responsive/>
        </div>
    
        <div class="sm:w-32 md:w-48 lg:w-64 ">
            <x-stat
                title="Sales"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-down"
                class="text-orange-500"
                color="text-pink-500"
                tooltip-right="Gosh!" responsive/>
        </div>
    </div>

 
    <div class="grid gap-5">
    <x-button label="Randomize" wire:click="randomize" class="btn-primary" spinner />
    <x-button label="Switch" wire:click="switch" spinner />
</div>

<x-chart wire:model="myChart" />

</div>
 


