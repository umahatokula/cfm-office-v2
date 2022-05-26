<?php

namespace App\Models;

use App\Models\Cell;
use App\Models\Gender;
use App\Models\ServiceTeam;
use App\Models\MaritalStatus;
use App\Models\CellChurchColony;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LifeCoach extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];


    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getNameAttribute()
    {
        $fname = isset($this->attributes['fname']) ? $this->attributes['fname'] : '';
        $lname = isset($this->attributes['lname']) ? $this->attributes['lname'] : '';

        return $fname .' '.$lname;
    }

     /**
     * The members that belong to the life coaches.
     */
    public function followuptargets()
    {
        return $this->belongsToMany(FollowupTarget::class, 'life_coach_targets', 'life_coach_id', 'followup_target_id');
    }

    public function gender() {
        return $this->belongsTo(Gender::class)->withDefault();
    }

    public function serviceTeam() {
        return $this->belongsTo(ServiceTeam::class)->withDefault();
    }

    public function cell() {
        return $this->belongsTo(Cell::class)->withDefault();
    }

    public function colony() {
        return $this->belongsTo(CellChurchColony::class, 'c3_id', 'id')->withDefault();
    }

    public function maritalStatus() {
        return $this->belongsTo(MaritalStatus::class)->withDefault();
    }

    public function church() {
        return $this->belongsTo(Church::class)->withDefault();
    }

}
