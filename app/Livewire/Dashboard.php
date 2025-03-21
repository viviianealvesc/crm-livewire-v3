<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $topWorks;

    // public array $myChart = [
    //     'type' => 'pie',
    //     'data' => [
    //         'labels' => ['Mary', 'Joe', 'Ana'],
    //         'datasets' => [
    //             [
    //                 'label' => '# of Votes',
    //                 'data' => [12, 19, 3],
    //             ]
    //         ]
    //     ]
    // ];

    public array $mySecondChart = [];

    public function randomize()
    {
        // Arr::set($this->myChart, 'data.datasets.0.data', [
        //     fake()->randomNumber(2),
        //     fake()->randomNumber(2),
        //     fake()->randomNumber(2)
        // ]);

        Arr::set($this->mySecondChart, 'data.datasets.0.data', [
            fake()->randomNumber(2),
            fake()->randomNumber(2),
            fake()->randomNumber(2)
        ]);
    }

    public function switch()
    {
        // $type = $this->myChart['type'] == 'bar' ? 'pie' : 'bar';
        // Arr::set($this->myChart, 'type', $type);

        $secondType = $this->mySecondChart['type'] == 'bar' ? 'pie' : 'bar';
        Arr::set($this->mySecondChart, 'type', $secondType);
    }

    public function static()
    {
        $this->topWorks = Client::select('work', DB::raw('COUNT(*) as total'))
        ->groupBy('work')
        ->orderByDesc('total')
        ->limit(4)
        ->get();

        $this->mySecondChart = [
            'type' => 'bar',
            'data' => [
                'labels' => $this->topWorks->pluck('work')->toArray(),
                'datasets' => [
                    [
                        'label' => '# clientes',
                        'data' => $this->topWorks->pluck('total')->toArray(),
                    ]
                ]
            ]
        ];

    }

    public function render()
    {
        sleep(0.5);
        $clients = Client::all();

        $this->static();

        return view('livewire.dashboard', compact('clients'));
    }
}