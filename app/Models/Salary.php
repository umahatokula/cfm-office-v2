<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\SalarySchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'breakdown', 'month_of_salary', 'salary_schedule_id', 'year_of_salary'];

    protected $casts = [
        'breakdown' => 'array',
    ];

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id', 'id')->withDefault();
    }

    public function salarySchedule() {
        return $this->belongsTo(SalarySchedule::class, 'salary_schedule_id', 'id')->withDefault();
    }
}
