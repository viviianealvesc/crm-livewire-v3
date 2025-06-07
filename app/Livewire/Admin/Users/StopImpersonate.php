<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class StopImpersonate extends Component
{

    public function render()
    {
        return view('livewire.admin.users.stop-impersonate', [
            'user' => Auth::user()
        ]);
    }

    public function stopImpersonate()
    {
        session()->forget('impersonate');

        return redirect('admin/users');
    }
}


