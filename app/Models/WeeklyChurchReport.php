<?php

namespace App\Models;

use App\Models\Church;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class WeeklyChurchReport extends Model
{
    protected $dates = ['from', 'to'];

    public function tasks()
    {
        return $this->hasMany(ChurchTask::class);
    }

    public function activities()
    {
        return $this->hasMany(ChurchActivity::class);
    }

    public function churchProgramEvaluation()
    {
        return $this->hasMany(ChurchProgramEvaluation::class);
    }

    public function sunTestimonies()
    {
        return $this->hasMany(ChurchSundayTestimony::class);
    }

    public function wedTestimonies()
    {
        return $this->hasMany(ChurchWednesdayTestimony::class);
    }

    public function filedBy()
    {
        return $this->belongsTo(Member::class, 'filed_by', 'id');
    }

    public function checkedBy()
    {
        return $this->belongsTo(Member::class, 'checked_by', 'id');
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
