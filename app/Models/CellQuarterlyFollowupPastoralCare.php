<?php

namespace App\Models;

use App\Models\CellQuarterlyFollowup;
use Illuminate\Database\Eloquent\Model;

class CellQuarterlyFollowupPastoralCare extends Model
{

	public function cellQuarterlyFollowup(){
		return $this->hasMany(CellQuarterlyFollowup::class);
	}
}
