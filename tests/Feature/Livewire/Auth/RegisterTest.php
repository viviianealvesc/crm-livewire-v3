<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class) //chamando o componente
        ->set('name', 'John Doe')
        ->set('email', 'johndoe@.com') //setando os valores dos inputs
        ->set('email_conformation', 'johndoe@.com') 
        ->set('password', 'password')
        ->call('submit')  //chamando o método submit (submit é o nome da função que faz o registro)
        ->assertHasNoErrors();  //verificando se não tem erros

        assertDatabaseHas('users', [ //verificando se o usuário foi criado no banco
            'name' => 'John Doe',
            'email' => 'johndoe@.com'
        ]);

        assertDatabaseCount('users', 1); //verificando se só tem um usuário no banco
});
