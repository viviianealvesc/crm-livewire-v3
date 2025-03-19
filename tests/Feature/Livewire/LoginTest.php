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
    ->call('submit')
    ->assertHasNoErrors(['invalidCredentials'])
    ->assertRedirect('/')
    ->assertSee(trans('auth.failed'));
});


it('should make sure that the rate limiting is blocking after 5 attemps', function () {

    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        Livewire::teste(Login::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('submit')
        ->assertHasNoErrors(['invalidCredentials']);
    }

    Livewire::teste(Login::class)
    ->set('email', $user->email)
    ->set('password', 'wrong-password')
    ->call('submit')
    ->assertHasNoErrors(['rateLimiter']);

});