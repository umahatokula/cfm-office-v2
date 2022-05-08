<?php

namespace App\Models;

use App\Models\ChartOfAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionType extends Model
{
    use HasFactory;

    protected $casts = [
        'dr_cr_codes' => 'array',
    ];

    public function getAccountCode($trxn_type) : int {

        $account = ChartOfAccount::where('code', $this->dr_cr_codes[$trxn_type])->first();

        return $account ? $account->code : null;
    }
}
