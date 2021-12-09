<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \App\Person;
use \App\Role;
use \App\User;
use \App\Status;
use \App\Helpers\Helper;

class Church extends Model
{

	protected $fillable = array('name', 'address', 'email', 'phone', 'person_id', 'status');

	protected $mappingProperties = array(
	    'name' => [
	      'type' => 'string',
	      "analyzer" => "standard",
	    ],
	    'address' => [
	      'type' => 'string',
	      "analyzer" => "standard",
	    ],
	    'email' => [
	      'type' => 'string',
	      "analyzer" => "standard",
	    ],
	  );

    public function members(){
    	return $this->hasMany('\App\Person');
    }

    public function person(){
    	return $this->belongsTo('\App\Person');
    }

    public function status(){
    	return $this->belongsTo('\App\Status');
    }

    public function pastors(){
    	return $this->hasMany('\App\Pastor');
    }

    //a church can have may users
    public function users(){
    	return $this->hasManyThrough('User', 'Person');
    }

	public function scopeIsActive($query) {
		$query->where('is_active', 1);
	}


}
