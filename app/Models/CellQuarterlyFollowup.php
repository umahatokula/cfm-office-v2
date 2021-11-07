<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CellQuarterlyFollowupNCBI;
use App\Models\CellQuarterlyFollowupSoulsWon;
use App\Models\CellQuarterlyFollowupFollowedUp;
use App\Models\CellQuarterlyFollowupPastoralCare;

class CellQuarterlyFollowup extends Model
{

	public function followUps(){
		return $this->hasMany(CellQuarterlyFollowupFollowedUp::class);
	}

	public function ncbi(){
		return $this->hasMany(CellQuarterlyFollowupNCBI::class);
	}

	public function pastoralCares(){
		return $this->hasMany(CellQuarterlyFollowupPastoralCare::class);
	}

	public function soulsWon(){
		return $this->hasMany(CellQuarterlyFollowupSoulsWon::class);
	}
}
