<?php

namespace App\Models;

use App\Models\CellQuarterlyFollowup;
use Illuminate\Database\Eloquent\Model;

class CellQuarterlyFollowupSoulsWon extends Model
{
    protected $table = 'cell_quarterly_followup_souls_won';

	public function cellQuarterlyFollowup(){
		return $this->hasMany(CellQuarterlyFollowup::class);
	}
}
