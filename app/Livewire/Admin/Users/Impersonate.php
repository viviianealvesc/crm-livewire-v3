<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\On;



class Impersonate extends Component
{
    public function render(): string
    {
        return <<<'HTML'
        <div></div>
        HTML;
    }

    #[On('user::impersonate')]
    public function impresonate(int $id): void
    {
        session()->put('impersonate', $id);

        $this->redirect(route('dashboard'));
    }
}
