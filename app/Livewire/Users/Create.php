<?php

namespace App\Livewire\Users;

use Livewire\Component;

class Create extends Component
{
    public bool $showDrawer3 = false;
    
    public function render()
    {
        return view('livewire.users.create');
    }
}
