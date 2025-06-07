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
        $this->authorize('be an admin');

        if (auth()->id() == $id) {
            throw new \Exception('Você não pode se auto-impersonar'); // Se forem iguais, lança uma exceção com a mensagem "Você não pode se auto-impersonar".
        }

        session()->put('impersonate', $id);

        $this->redirect(route('dashboard'));
    }
}
