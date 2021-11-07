<?php

namespace App\Models;

use App\Models\Status;
use App\Models\ChartOfAccount;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expense_heads';

    protected $guarded = ['id'];

    // A Expense Head BELONGS TO a Chart Of Account
    public function coa() {
        return $this->belongsTo(ChartOfAccount::class, 'chart_of_account_id'); // this matches the Eloquent model
    }


    public function status(){
    	return $this->belongsTo(Status::class);
    }
}
