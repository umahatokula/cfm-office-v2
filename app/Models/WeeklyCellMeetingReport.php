<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\WeeklyCellMeetingProgramSummary;

class WeeklyCellMeetingReport extends Model
{
	protected $dates = [
        'date_held',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

	public function programSummaries(){
		return $this->hasMany(WeeklyCellMeetingProgramSummary::class);
	}
}
