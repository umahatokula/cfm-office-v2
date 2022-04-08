<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;

    protected $fillable = ['salary_id', 'staff_id', 'breakdown'];

    protected $casts = [
        'breakdown' => 'array',
    ];

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id', 'id')->withDefault();
    }

    public function salary() {
        return $this->belongsTo(Salary::class, 'salary_id', 'id')->withDefault();
    }
}
