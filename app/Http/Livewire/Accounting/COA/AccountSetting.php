<?php

namespace App\Http\Livewire\Accounting\COA;

use App\Models\ChartOfAccount;
use App\Models\TransactionType;
use Livewire\Component;

class AccountSetting extends Component
{
    public $accounts;
    public $trxn_types;
    public $dr = null;
    public $cr = null;

    protected $rules = [
        'dr' => 'required',
        'cr' => 'required',
    ];

    protected $messages = [
        'dr.required' => 'Select a DR account for the transaction type',
        'cr.required' => 'Select a CR account for the transaction type',
    ];

    protected $listeners = ['accountLinked'];

    public function mount() {

        $this->trxn_types = TransactionType::all();

//        $this->accounts = ChartOfAccount::whereNull('chart_of_account_id')
//            ->with('childrenAccounts')
//            ->get();

        $this->accounts = ChartOfAccount::all()->toArray();

    }

    public function accountLinked($name) {

        $this->validate();

        $trxnType = TransactionType::where('name', $name)
            ->update(['dr_cr_codes->dr' => $this->dr, 'dr_cr_codes->cr' => $this->cr]);

        $this->reset(['dr', 'cr']);

        session()->flash('message', $trxnType->description.' successfully linked.');
    }

    public function render()
    {
        return view('livewire.accounting.c-o-a.account-setting');
    }
}
