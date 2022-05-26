<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServiceTeam extends Model
{

	use SearchableTrait;

	protected $searchable = [
		'columns' => [
		'service_teams.name' => 10
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


    public function ServiceTeamleader() {
    	return $this->belongsTo('App\Models\Member', 'leader', 'id', 'members');
    }
}
