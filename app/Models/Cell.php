<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Region;
use App\Models\AgeProfile;
use App\Models\CellLeader;
use App\Models\WeeklyCellMeetingReport;
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

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeChurch($query)
    {
        $query->where('church_id', auth()->user()->member->church_id);
    }

	public function members(){
		return $this->hasMany(Member::class);
	}

	public function cellLeaders(){
		return $this->hasMany(CellLeader::class);
	}

	public function ageProfile(){
		return $this->belongsTo(AgeProfile::class);
	}

	public function region(){
		return $this->belongsTo(Region::class);
	}

	public function reports()
	{
	    return $this->hasMany(WeeklyCellMeetingReport::class, 'cell_id', 'id');
	}
}
