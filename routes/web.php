<?php

use Livewire\Volt\Volt;
use App\Livewire\Auth\{Register, Login};
use Illuminate\Support\Facades\{Route, Auth};

Route::middleware('auth')->group(function () {

   Volt::route('/', 'users.index')->name('dashboard');

   Route::get('/logout', function () {
      Auth::logout();
      return redirect()->route('auth.login');
   });   

   //Admin
   Route::prefix('/admin')->middleware('can:be-an-admin')->group(function () {
      Route::get('/dashboard', fn() => 'admin.dashboard')->name('admin.dashboard');
   });

});


Route::get('/register', Register::class)->name('auth.register');
Route::get('/login', Login::class)->name('auth.login');
