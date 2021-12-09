<?php

namespace App\Models;

use App\Models\CellQuarterlyFollowup;
use Illuminate\Database\Eloquent\Model;

class CellQuarterlyFollowupNCBI extends Model
{
    protected $table = 'cell_quarterly_followup_ncbi';

	public function cellQuarterlyFollowup(){
		return $this->hasMany(CellQuarterlyFollowup::class);
	}
}
