<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgeProfile extends Model
{

	public function members(){
		return $this->hasMany('\App\Member');
	}
	
	public function cells(){
		return $this->hasMany('\App\Cell');
	}
}
