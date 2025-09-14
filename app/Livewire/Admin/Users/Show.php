<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\WithPagination; 
use Illuminate\Pagination\LengthAwarePaginator; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class Show extends Component
{
    use WithPagination; 
    use Toast;

    public bool $drawer = false;
    
    public bool $myModal12 = false;

        public array $formInputs = [];

        public array $books = [];

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    protected $listeners = ['refreshTable' => 'users'];

    public function mount(): void
    {
        $this->authorize('be an admin');
    }

    public function addForm()
    {
        $this->formInputs[] = [
            'name' => '', 
            'email' => ''
        ];


    }

    public function removeForm($index)
    {
        unset($this->formInputs[$index]);
        $this->formInputs = array_values($this->formInputs); // reorganiza os índices
    }

    public function search(string $value = '')
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $value,
            'maxResults' => 10,
        ]);

        $this->books = collect($response->json()['items'] ?? [])
            ->map(function ($item) {
                return [
                    'value' => $item['id'] ?? null,
                    'name' => $item['volumeInfo']['title'] ?? '',
                ];
            })
            ->toArray();
    }


    public function save()
    {
        dd($this->formInputs);
        
        foreach ($this->formInputs as $data) {
            // Validação (você pode usar rules mais específicas)
            if (!empty($data['name']) && !empty($data['email'])) {
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
            }
        }

        session()->flash('success', 'Formulários salvos com sucesso!');
        $this->reset('formInputs');
        $this->mount(); // Adiciona um formulário vazio novamente
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


    public function users(): LengthAwarePaginator 
    {
        sleep(0.5);
        return User::query()
            ->with('permissions')
            ->whereNull('archived_at')
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"));
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
