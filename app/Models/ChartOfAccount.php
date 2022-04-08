<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $table = 'chart_of_accounts';

    public function accounts()
    {
        return $this->hasMany(ChartOfAccount::class);
    }

    public function childrenAccounts()
    {
        return $this->hasMany(ChartOfAccount::class)->with('accounts');
    }
}
