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


    public function ServiceTeamleader() {
    	return $this->belongsTo('App\Member', 'leader', 'id', 'members');
    }
}
