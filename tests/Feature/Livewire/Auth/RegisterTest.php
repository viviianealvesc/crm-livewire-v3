<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;
use App\Models\User;


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
        ->assertHasNoErrors()  //verificando se não tem erros
        ->assertRedirect('/'); //verificando se redirecionou para a home

        assertDatabaseHas('users', [ //verificando se o usuário foi criado no banco
            'name' => 'John Doe',
            'email' => 'johndoe@.com'
        ]);
        
        assertDatabaseCount('users', 1); //verificando se só tem um usuário no banco

        expect(auth()->check())
        ->and->expect(auth()->user())
        ->id->toBe(User::first()->id);
});

test('validation rules', function ($f) {

    if($f->rule === 'unique') {
        User::factory()->create([$f->field => $f->value]);
    }

    $livewire = Livewire::test(Register::class)
        ->set($f->field, $f->value);

    if(property_exists($f, 'aValue'))
    {
        $livewire->set($f->aField, $f->aValue);
    }

    $livewire->call('submit')
        ->assertHasErrors([$f->field => $f->rule]); 

})->with([
    'name::require' => (object)['field' => 'name', 'value' => '', 'rule' => 'required'], 
    'name::max:255' => (object)['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max'], 
    'email::require' => (object)['field' => 'email', 'value' => '', 'rule' => 'required'], 
    'email::email' => (object)['field' => 'email', 'value' => 'not-an-email', 'rule' => 'required'], 
    'email::max:255' => (object)['field' => 'email', 'value' => str('*', '@doe.com', 256), 'rule' => 'max'], 
    'email::confirmation' => (object)['field' => 'email', 'value' => str('*', 'joe@doe.com', 256), 'rule' => 'confirmed'], 
    'email::unique' => (object)['field' => 'email', 'value' => 'johndoe@.com', 'rule' => 'unique', 'aField' => 'email_confirmation', 'aValue' => 'johndoe@.com'],
    'password::require' => (object)['field' => 'password', 'value' => '', 'rule' => 'required'],
]);  // verificando se os campos são obrigatórios
