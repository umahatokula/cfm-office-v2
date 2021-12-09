<?php

namespace App\Models;

use App\Models\Family;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberFamily extends Model
{

    protected $casts = ['is_parent' => 'boolean'];
    
	public function member() {
		return $this->belongsTo(Member::class);
	}

	public function family() {
		return $this->belongsTo(Family::class);
	}
}
