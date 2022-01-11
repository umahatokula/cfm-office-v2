<?php

namespace App\Http\Livewire\Accounting\Requisitions;

use Livewire\Component;
use App\Models\AccountType;
use App\Models\Requisition;

class ListRequisitions extends Component
{    
    public $requisitions, $operationsAccbalance;
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        
        $this->requisitions = Requisition::where(['church_id' => auth()->user()->member->church_id])->get();
        $this->operationsAccbalance = AccountType::where(['id' => 4, 'church_id' => \Auth::user()->member->church_id])->first();
    }
    public function render()
    {
        return view('livewire.accounting.requisitions.list-requisitions');
    }
}
