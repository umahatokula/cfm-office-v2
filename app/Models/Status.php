<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	// use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'status';

}
