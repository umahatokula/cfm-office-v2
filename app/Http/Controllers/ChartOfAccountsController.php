<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartOfAccount;

class ChartOfAccountsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() {

        $accounts = ChartOfAccount::whereNull('chart_of_account_id')
            ->with('childrenAccounts')
            ->get();

        return view('accounting.coa.index', compact('accounts'));
    }
}
