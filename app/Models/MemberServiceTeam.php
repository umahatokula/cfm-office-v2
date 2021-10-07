<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberServiceTeam extends Model
{
	public function member(){
		return $this->belongsTo('\App\Member');
	}

	public function serviceTeam(){
		return $this->belongsTo('\App\ServiceTeam');
	}
}
