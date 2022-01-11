<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    protected $fillable = [
        'requisition_id',
        'expense_head_id',
        'description',
        'qty',
        'unit_cost',
        'total_cost',
    ];
}
