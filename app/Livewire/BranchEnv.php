<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Process;

/**
 * @property-read string $branch
 */

class BranchEnv extends Component
{
    public function render()
    {
        return view('livewire.branch-env');
    }

    #[Computed]
    public function branch(): string
    {
        $process = Process::run('git branch --show-current');
        return $process->output();
    }
}
