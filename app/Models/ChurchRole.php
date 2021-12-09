<?php

namespace App\Models;

use App\MemberChurchRole;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChurchRole extends Model
{

	use SearchableTrait;

	protected $searchable = [
		'columns' => [
		'church_roles.name' => 10
		]
	];

	public function members(){
		return $this->hasMany(MemberChurchRole::class);
	}
}
