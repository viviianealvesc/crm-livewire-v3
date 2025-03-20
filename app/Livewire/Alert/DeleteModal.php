<?php

namespace App\Livewire\Alert;

use Livewire\Component;
use App\Models\Client;

class DeleteModal extends Component
{
    public bool $myModal2 = false;

    public $client;

    public function render()
    {
        return view('livewire.alert.delete-modal');
    }

    public function delete($id): void
    {
        $clientId = Client::findOrFail($id);
        $clientId->delete();
    }
}
