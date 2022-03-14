<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'breakdown', 'month_of_salary'];

    protected $casts = [
        'breakdown' => 'array'
    ];
}
