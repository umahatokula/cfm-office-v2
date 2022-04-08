<?php

namespace App\Models;

use App\Models\SalarySchedule;
use App\Models\SalaryScheduleElement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryScheduleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['salary_schedule_id', 'salary_schedule_element_id', 'amount', 'percentage'];

	public function salarySchedule(){
		return $this->belongsTo(SalarySchedule::class)->withDefault();
	}

	public function salaryScheduleElement(){
		return $this->belongsTo(SalaryScheduleElement::class)->withDefault();
	}
}
