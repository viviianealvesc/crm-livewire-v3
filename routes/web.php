<?php

use Livewire\Volt\Volt;
use App\Livewire\Auth\Register;

Volt::route('/', 'users.index');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/logout', 
   fn () => tap(Auth::logout(), fn () => redirect('/'))
);