<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\Client;

class Dashboard extends Component
{
    public array $myChart = [
        'type' => 'pie',
        'data' => [
            'labels' => ['Mary', 'Joe', 'Ana'],
            'datasets' => [
                [
                    'label' => '# of Votes',
                    'data' => [12, 19, 3],
                ]
            ]
        ]
    ];

    public array $mySecondChart = [
        'type' => 'bar',
        'data' => [
            'labels' => ['Alice', 'Bob', 'Charlie'],
            'datasets' => [
                [
                    'label' => '# of Votes',
                    'data' => [5, 15, 8],
                ]
            ]
        ]
    ];

    public function randomize()
    {
        Arr::set($this->myChart, 'data.datasets.0.data', [
            fake()->randomNumber(2),
            fake()->randomNumber(2),
            fake()->randomNumber(2)
        ]);

        Arr::set($this->mySecondChart, 'data.datasets.0.data', [
            fake()->randomNumber(2),
            fake()->randomNumber(2),
            fake()->randomNumber(2)
        ]);
    }

    public function switch()
    {
        $type = $this->myChart['type'] == 'bar' ? 'pie' : 'bar';
        Arr::set($this->myChart, 'type', $type);

        $secondType = $this->mySecondChart['type'] == 'bar' ? 'pie' : 'bar';
        Arr::set($this->mySecondChart, 'type', $secondType);
    }

    public function render()
    {
        $clients = Client::all();
        return view('livewire.dashboard', compact('clients'));
    }
}