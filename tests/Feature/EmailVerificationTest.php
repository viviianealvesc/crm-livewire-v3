<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Auth\Register;


class EmailVerificationTest extends TestCase
{
  
    public function test_verification_users_email(): void
    {
 
        Livewire::test(Register::class)
            ->set('name', 'John Doe')
            ->set('email', 'johndoe@.com')
            ->set('email_confirmation', 'johndoe@.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('RouteServiceProvider::HOME');

        \Pest\Laravel\assertDatabaseHas('users', 1);
    }
}
