<?php

namespace App\Models;

use App\Models\FollowupTarget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FollowUpReport extends Model
{
    use HasFactory;

    /**
     * The life-coaches that belong to the target.
     */
    public function life_coach() {
        return $this->belongsTo(LifeCoach::class, 'life_coach_id', 'id')->withDefault();
    }

    /**
     * The life-coaches that belong to the target.
     */
    public function followup_target() {
        return $this->belongsTo(FollowupTarget::class, 'followup_target_id', 'id')->withDefault();
    }
}
