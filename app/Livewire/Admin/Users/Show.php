<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\WithPagination; 
use Illuminate\Pagination\LengthAwarePaginator; 

class Show extends Component
{
    use WithPagination; 
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    
    public bool $myModal12 = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    protected $listeners = ['refreshTable' => 'clients'];

    public function mount(): void
    {
        $this->authorize('be an admin');
    }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

       // Table headers
       public function headers(): array
       {
           return [
               ['key' => 'id', 'label' => '#'],
               ['key' => 'name', 'label' => 'Name'],
               ['key' => 'email', 'label' => 'E-mail'],
               ['key' => 'permission', 'label' => 'Permissão'],
           ];
       }
       

    public function clients(): LengthAwarePaginator 
    {
        sleep(0.5);
        return User::query()
            ->whereNull('archived_at')
            ->when($this->search, fn(\Illuminate\Database\Eloquent\Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->orderBy('created_at', 'desc')
           ;
    }

    public function with(): array
    {
        return [
            'clients' => $this->clients(),
            'headers' => $this->headers()
        ];
    }
   
    public function render()
    {
        $users = User::query()->paginate(5);

        return view('livewire.users.show', [
            'users' => $users,
            'headers' => $this->headers()
        ]);
    }
}
