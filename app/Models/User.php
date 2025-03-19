<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function givePermissionTo(string $key)
    {
        $this->permissions()->firstOrCreate(compact('key'));

        //toda vez que eu adicionar uma nova permissão, eu vou apagar o meu chache e 
        // procurar novamente as permissões no banco
        Cache::forget("user::{$this->id}::permissions");

        Cache::remenberForever("user::{$this->id}::permissions", 
                 fn() => $this->permissions);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo(string $key): bool
    {
        $permissions = Cache::get("user::{$this->id}::permissions", $this->permissions);

        return $permissions
                -> where('key', $key)
                ->isNotEmpty();
    }

    
}
