<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
	use SoftDeletes;
	
    protected $table = 'gender';

//Gender belongs to many persons
    public function person(){
    	return $this->hasMany('\App\Person');
    }
}
