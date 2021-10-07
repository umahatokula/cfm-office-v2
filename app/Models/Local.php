<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Local extends Model
{
    // An lga HAS MANY persons
    public function person() {
        return $this->hasMany('\App\Person'); // this matches the Eloquent model
    }
}
