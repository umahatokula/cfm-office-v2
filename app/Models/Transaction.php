<?php

namespace App\Models;

use App\Events\TransactionOccured;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['code_cr', 'code_dr', 'amount', 'description', 'value_date', 'created_at'];

    /**
     * offeringEvent
     *
     * @param  mixed $amount
     * @param  mixed $description
     * @param  mixed $valueDate
     * @return int
     */
    public static function prepTransactionEvent(string $name, $amount, string $description, string $date) : int {

        $trxnType = TransactionType::where('name', $name)->first();

        if (!$trxnType || count($trxnType->dr_cr_codes) == 0) {
            return 0;
        }

        event(new TransactionOccured(
            $trxnType->getAccountCode('cr'),
            $trxnType->getAccountCode('dr'),
            $amount,
            $description,
            $date
        ));

        return 1;
    }
}
