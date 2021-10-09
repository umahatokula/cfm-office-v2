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
     * The members that belong to the life coaches.
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'life_coach_targets');
    }

}
