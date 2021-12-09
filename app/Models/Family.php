<?php

namespace App\Models;

use App\Models\MemberFamily;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	public function members() {
		return $this->hasMany(MemberFamily::class);
	}
}
