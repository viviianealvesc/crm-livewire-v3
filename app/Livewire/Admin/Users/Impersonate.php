<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class Impersonate extends Component
{
    public function render(): string
    {
        return <<<'HTML'
        <div></div>
        HTML;
    }

    public function impresonate(int $id): void
    {
        session->put('impersonate', $id);
    }
}
