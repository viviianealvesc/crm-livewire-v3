<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['key'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
