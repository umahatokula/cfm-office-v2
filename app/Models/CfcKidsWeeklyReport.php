<?php

namespace App\Models;

use App\Models\Church;
use Illuminate\Database\Eloquent\Model;

class CfcKidsWeeklyReport extends Model
{

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
