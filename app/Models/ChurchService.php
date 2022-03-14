<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ChurchService extends Model
{
	protected $dates = ['service_date'];

	public function serviceType(){
		return $this->belongsTo('\App\Models\ServiceType');
	}

	public function church()
	{
	    return $this->belongsTo(Church::class);
	}

	public function submittedBy()
	{
			return $this->belongsTo('App\Models\Member', 'submitted_by', 'id');
	}
}
