<?php

use App\Livewire\Auth\Login;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Login::class)
        ->assertOk();
});

it('should be able to login', function () {
   $user = User::factory()->create([
        'email' => 'johndoe@.com',
        'password' => 'password',
    ]);

    Livewire::teste(Login::class)
    ->set('email', 'johndoe@.com')
    ->set('password', 'password')
    ->call('tryToLogin')
    ->assertHasNoErrors()
    ->assertRedirect('/');

    espect(auth()->check())->toBeTrue()
    ->and(auth()->user())->id->toBe($user->id);
});

it('should make sure to inform the user error when email and password doenst work', function () {

    Livewire::teste(Login::class)
    ->set('email', 'johndoe@.com')
    ->set('password', 'password')
    ->call('tryToLogin')
    ->assertHasNoErrors(['invalidCredentials'])
    ->assertRedirect('/')
    ->assertSee(trans('auth.failed'));
});
