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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    public function salaryDetails() {
        return $this->hasMany(SalaryDetail::class, 'salary_id', 'id');
    }

    public function salarySchedule() {
        return $this->belongsTo(SalarySchedule::class, 'salary_schedule_id', 'id')->withDefault();
    }

    public function getSalaryTotal() {
        $details = $this->salaryDetails;

        $sum = 0;
        foreach ($details as $detail) {
            $sum += array_sum($detail->breakdown);
        }

        return $sum;
    }
}
