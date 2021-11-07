<?php

namespace App\Models;

use App\Models\Member;
use App\Models\ChurchRole;
use Illuminate\Database\Eloquent\Model;

class MemberChurchRole extends Model
{

	public function member(){
		return $this->belongsTo(Member::class);
	}

	public function churchRole(){
		return $this->belongsTo(ChurchRole::class);
	}
}
