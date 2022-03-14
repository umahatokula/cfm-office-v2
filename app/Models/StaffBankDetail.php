<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'bank_id',
        'account_number',
        'account_name',
        'is_primary',
    ];
    
    /**
     * bank
     *
     * @return void
     */
    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id', 'id')->withDefault();
    }
    
    /**
     * bank
     *
     * @return void
     */
    public function bank() {
        return $this->belongsTo(Bank::class, 'bank_id', 'id')->withDefault();
    }
}
