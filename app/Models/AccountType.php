<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
