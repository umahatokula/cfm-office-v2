<?php

namespace App\Models;

use App\Models\SalaryScheduleComponent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalarySchedule extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
    	
	/**
	 * schedule Components
	 *
	 * @return void
	 */
	public function scheduleComponents(){
		return $this->hasMany(SalaryScheduleComponent::class);
	}
    
    /**
     * Get Total On this Schedule
     *
     * @return void
     */
    public function getTotalOnSchedule() {
        return $this->scheduleComponents()->sum('amount');
    }
}
