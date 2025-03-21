<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function archive()
    {
        $this->update(['archived_at' => now()]);
    }

    public function restoreArchive()
    {
        $this->update(['archived_at' => null]);
    }

}
