<?php

namespace App\Models;

use App\Models\WeeklyCellMeetingReport;
use Illuminate\Database\Eloquent\Model;

class WeeklyCellMeetingProgramSummary extends Model
{

	public function report(){
		return $this->belongsTo(WeeklyCellMeetingReport::class);
	}
}
