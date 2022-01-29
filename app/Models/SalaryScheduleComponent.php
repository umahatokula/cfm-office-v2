<?php

namespace App\Models;

use App\Models\SalarySchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryScheduleComponent extends Model
{
    use HasFactory;

    protected $fillable = ['salary_schedule_id', 'salary_schedule_element_id', 'amount'];
    
	public function scheduleComponents(){
		return $this->belongsTo(SalarySchedule::class);
	}
}
