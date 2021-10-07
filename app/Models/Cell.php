<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cell extends Model
{

	use SearchableTrait;

	protected $searchable = [
		'columns' => [
		'cells.name' => 10
		]
	];

	public function members(){
		return $this->hasMany('\App\Member');
	}

	public function cellLeaders(){
		return $this->hasMany('\App\CellLeader');
	}

	public function ageProfile(){
		return $this->belongsTo('\App\AgeProfile');
	}

	public function region(){
		return $this->belongsTo('\App\Region');
	}

	public function reports()
	{
	    return $this->hasMany(WeeklyCellMeetingReport::class, 'cell_id', 'id');
	}
}
