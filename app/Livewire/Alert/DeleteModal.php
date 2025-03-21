<?php

namespace App\Livewire\Alert;

use Livewire\Component;
use App\Models\Client;
use Mary\Traits\Toast;

class DeleteModal extends Component
{
    use Toast;

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

    
    public function restores($id)
    {
        $client = Client::whereNotNull('archived_at')->find($id);
        $client->restoreArchive(); // Cliente ativo novamente
        
        $this->dispatch('refreshTable');

        $this->myModal2 = false;
        
        $this->success('Cliente restaurado com sucesso!', position: 'toast-bottom');
    }

    public function delete($id): void
    {
        $clientId = Client::findOrFail($id);
        $clientId->delete();

        $this->dispatch('refreshTable');

        $this->myModal2 = false;

        $this->success('Cliente deletado com sucesso.', position: 'toast-bottom');
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->restore();

        $this->dispatch('refreshTable');

        $this->myModal2 = false;
        
        $this->success('Cliente restaurado com sucesso!', position: 'toast-bottom');
    }

    public function deletePermanently($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->forceDelete();

        $this->dispatch('refreshTable');

        $this->myModal2 = false;

        $this->success('Cliente excluído permanentemente!', position: 'toast-bottom');
    }
 

}
