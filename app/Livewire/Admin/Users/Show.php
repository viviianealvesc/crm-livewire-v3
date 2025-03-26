<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\{User, Permission};
use Mary\Traits\Toast;
use Livewire\WithPagination; 
use Illuminate\Pagination\LengthAwarePaginator; 
use \Illuminate\Database\Eloquent;
use Illuminate\Database\Query\Builder;

class Show extends Component
{
    use WithPagination; 
    use Toast;

    public ?string $search = null;

    public array $search_permissions = [];

    public bool $drawer = false;
    
    public bool $myModal12 = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    protected $listeners = ['refreshTable' => 'users'];

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
               ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500 w-1 text-center'],
               ['key' => 'name', 'label' => 'Name', 'class' => 'text-left font-bold'],
               ['key' => 'email', 'label' => 'E-mail'],
               ['key' => 'permission', 'label' => 'Permissão'],
           ];
       }
       

    #[Computed]
    public function users(): Collection 
    {
        $this->validate(['search_permissions' => 'exists:permissions,id']);

        return User::query()
        ->when($this->search, fn(Builder $q) => $q->where(BD::raw('LOWER(name)'), 
           'LIKE', '%' . strtolower($this->search) . '%')
        ->orWhere('email', 'like', '%' . strtolower($this->search) . '%'))
        ->when(
            $this->search_permissions, 
            fn(Builder $q) => $q->whereHas('permissions', function(Builder $query){
                $query->whereIn('id', $this->search_permissions);
            }))
        ->get();
    }

    public function with(): array
    {
        return [
            'users' => $this->users(),
            'headers' => $this->headers()
        ];
    }

   
    public function render()
    {
        $users = User::with('permissions')->paginate(10);

        return view('livewire.users.show', [
            'users' => $users,
            'headers' => $this->headers()
        ]);
    }
}
