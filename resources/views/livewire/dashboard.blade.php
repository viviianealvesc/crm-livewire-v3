<div>
    <div class="flex flex-col sm:flex-row sm:space-x-12 sm:space-y-0 space-y-4 justify-center mt-12">
        <div class="lg:w-80">
            <x-stat
                title="Total de Clientes"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-up"
                tooltip-bottom="There"
                responsive
                shadow
            />
        </div>
        
        <div class="lg:w-80">
            <x-stat
                title="Lost"
                description="This month"
                value="34"
                icon="o-arrow-trending-down"
                tooltip-left="Ops!"
                responsive
                shadow
            />
        </div>
        
        <div class="lg:w-80">
            <x-stat
                title="Sales"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-down"
                class="text-orange-500"
                color="text-pink-500"
                tooltip-right="Gosh!"
                responsive
                shadow
            />
        </div>
    </div>

    <div class="flex flex-col mt-12">
        <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
            <x-chart wire:model="mySecondChart" class="lg:h-64" responsive/>

            <x-card class="p-2" responsive shadow >
                <div class="p-2">
                    <h3 class="text-sm font-medium">Clientes Recentes</h3>
                    <ul class="mt-2 space-y-1">
                        @foreach($clients as $client)
                            <li class="flex justify-between items-center text-xs">
                                <span>{{ $client->name }}</span>
                                <span class="text-gray-400">{{ $client->created_at->format('d/m/Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-card>
        </div>
    </div>
</div>
    