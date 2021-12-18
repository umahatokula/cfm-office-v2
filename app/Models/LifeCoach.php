<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeCoach extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
    ];

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
        return $this->belongsToMany(FollowupTarget::class, 'life_coach_targets');
    }

}
