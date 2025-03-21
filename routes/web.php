<?php

use Livewire\Volt\Volt;
use App\Livewire\Auth\{Register, Login};
use Illuminate\Support\Facades\{Route, Auth};
use App\Enum\Can;
use App\Livewire\Dashboard;
use App\Livewire\Clients\{DeleteClient, ArchivedClient};

Route::middleware('auth')->group(function () {

   Route::get('/', Dashboard::class)->name('dashboard');
   
   Volt::route('/clients', 'clients.index')->name('clients.index');

   Route::get('/detete-client', DeleteClient::class)->name('clients.delete');

   Route::get('/archived', ArchivedClient::class)->name('clients.archived');

   Route::get('/logout', function () {
      Auth::logout();
      return redirect()->route('login');
   });   

   //Admin
   Route::prefix('/admin')->middleware('can:' . Can::BE_AN_ADMIN->value)->group(function () {
      Route::get('/dashboard', fn() => 'admin.dashboard')->name('admin.dashboard');
   });

});


Route::get('/register', Register::class)->name('auth.register');
Route::get('/login', Login::class)->name('login');
