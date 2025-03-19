<?php

use Livewire\Volt\Volt;
use App\Livewire\Auth\{Register, Login};
use Illuminate\Support\Facades\{Route, Auth};

Volt::route('/', 'users.index')->name('dashboard');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/login', Login::class)->name('auth.login');
Route::get('/logout', 
   fn () => tap(Auth::logout(), fn () => redirect('/'))
);