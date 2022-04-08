<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\SalaryDetail;
use App\Models\SalarySchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['month_of_salary', 'salary_schedule_id', 'year_of_salary'];

    public function salaryDetails() {
        return $this->hasMany(SalaryDetail::class, 'salary_id', 'id');
    }

    public function salarySchedule() {
        return $this->belongsTo(SalarySchedule::class, 'salary_schedule_id', 'id')->withDefault();
    }
}
