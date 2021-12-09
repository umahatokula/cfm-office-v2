<?php

namespace App\Models;

use App\Models\FollowupTarget;
use Illuminate\Database\Eloquent\Model;

class FollowupReason extends Model
{
	public function followUps(){
		return $this->hasMany(FollowupTarget::class, 'reason_id', 'id', 'follow_ups');
	}
}
