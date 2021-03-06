<?php

namespace App\Models;

use App\Models\Church;
use App\Models\LifeCoach;
use App\Models\AgeProfile;
use App\Models\FTGInterest;
use App\Models\FollowUpReport;
use App\Models\FTGInvitationMode;
use App\Models\FTGInformationNeed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * age_profile
     *
     * @return void
     */
    public function age_profile() {
        return $this->belongsTo(AgeProfile::class)->withDefault();
    }


    /**
     * age_profile
     *
     * @return void
     */
    public function church() {
        return $this->belongsTo(Church::class)->withDefault();
    }

    /**
     * The life-coaches that belong to the target.
     */
    public function lifecoaches() {
        return $this->belongsToMany(LifeCoach::class, 'life_coach_targets');
    }

    /**
     * The life-coaches that belong to the target.
     */
    public function reports() {
        return $this->hasMany(FollowUpReport::class, 'followup_target_id', 'id');
    }
    
    /**
     * FTG interests
     *
     * @return void
     */
    public function interests() {
        return $this->belongsToMany(FTGInterest::class, 'followup_target_ftginterest', 'followup_target_id', 'ftg_interest_id');
    }
    
    /**
     * FTG information needs
     *
     * @return void
     */
    public function information_needs() {
        return $this->belongsToMany(FTGInformationNeed::class, 'followup_target_ftginformation_need', 'followup_target_id', 'ftg_information_need_id');
    }
    
    /**
     * FTG invitation modes
     *
     * @return void
     */
    public function invitation_modes() {
        return $this->belongsToMany(FTGInvitationMode::class, 'followup_target_ftginvitation_mode', 'followup_target_id', 'ftg_invitation_mode_id');
    }
}
