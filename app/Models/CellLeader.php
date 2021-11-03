<?php

namespace App\Models;

use App\Models\Cell;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class CellLeader extends Model
{

    public function cellLeaders() {
    	return $this->hasMany(Member::class, 'leader', 'id', 'members');
    }

    public function cell() {
    	return $this->belongsTo(Cell::class);
    }

    public function member() {
    	return $this->belongsTo(Member::class);
    }
}
