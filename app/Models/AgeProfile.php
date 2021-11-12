<?php

namespace App\Models;

use App\Models\Cell;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class AgeProfile extends Model
{

	public function members(){
		return $this->hasMany(Member::class);
	}
	
	public function cells(){
		return $this->hasMany(Cell::class);
	}
}
