<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination; 
use Illuminate\Database\Eloquent\Builder;
use App\Models\Permission as PermissionModel;

class Permission extends Component
{
    use WithPagination; 

    public string $search = '';

    public PermissionModel $permission;

    public function render()
    {
        $permissions = PermissionModel::all();
 
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'key', 'label' => 'Permissão'],
        ];

        return view('livewire.admin.permission', [
            'headers' => $headers,
            'permissions' => $permissions
        ]);
    }

    public function users(): Collection
    {
        dd($this->search);
        return PermissionModel::query()
            ->when($this->search, fn(Builder $q) => $q->where('key', 'like', "%$this->search%"))
            ->get();
    }
}
