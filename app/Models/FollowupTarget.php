<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowupTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'age_profile_id',
        'status',
        'church_id',
        'assigned_by'
    ];

    /**
     * The life-coaches that belong to the member.
     */
    public function lifecoaches()
    {
        return $this->belongsToMany(LifeCoach::class, 'life_coach_targets');
    }
}
