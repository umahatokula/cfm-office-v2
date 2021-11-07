<?php

namespace App\Models;

use App\Models\Cell;
use App\Models\Gender;
use App\Models\ServiceTeam;
use Illuminate\Database\Eloquent\Model;

class CellMember extends Model
{
	protected $dates = ['date_joined', 'dob'];

    public function serviceTeam() {
    	return $this->belongsTo(ServiceTeam::class);
    }

    public function gender() {
    	return $this->belongsTo(Gender::class);
    }

    public function cell() {
    	return $this->belongsTo(Cell::class);
    }
}
