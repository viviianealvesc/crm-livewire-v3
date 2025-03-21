<?php

namespace App\Livewire\Alert;

use Livewire\Component;
use App\Models\Client;

class DeleteModal extends Component
{
    public bool $myModal2 = false;

    public $client;

    public $title = '';

    public $description = '';

    public $icon = '';

    public $colorIcon = '';

    public $tooltip = '';

    public $label = '';

    public $function = '';


    public function render()
    {
        return view('livewire.alert.delete-modal');
    }


    public function ClintArchived($id)
    {
        $client = Client::find($id);
        $client->archive(); // Cliente arquivado

        session()->flash('message', 'Cliente arquivado com sucesso.');
    }

    public function delete($id): void
    {
        $clientId = Client::findOrFail($id);
        $clientId->delete();
    }

 

}
