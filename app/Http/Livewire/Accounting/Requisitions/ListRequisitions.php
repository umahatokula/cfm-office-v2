<?php

namespace App\Http\Livewire\Accounting\Requisitions;

use Livewire\Component;
use App\Models\AccountType;
use App\Models\Requisition;
use App\Events\RequisitionApproved;

class ListRequisitions extends Component
{
    public $requisitions, $operationsAccbalance;

    public function render()
    {
        return view('livewire.accounting.requisitions.list-requisitions');
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount() {

        $this->requisitions = Requisition::where(['church_id' => auth()->user()->member->church_id])->get();
        $this->operationsAccbalance = AccountType::where(['id' => 4, 'church_id' => \Auth::user()->member->church_id])->first();
    }

    /**
     * approve
     *
     * @param  mixed $requisition
     * @return void
     */
    public function approve(Requisition $requisition) {
        $requisition->status_id = 3;
        $requisition->save();

        RequisitionApproved::dispatch($requisition);

        // reload requisitions
        $this->requisitions = Requisition::where(['church_id' => auth()->user()->member->church_id])->get();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Requisition approved']);
    }

    /**
     * disapprove
     *
     * @param  mixed $requisition
     * @return void
     */
    public function disapprove(Requisition $requisition) {
        $requisition->status_id = 5;
        $requisition->save();

        // reload requisitions
        $this->requisitions = Requisition::where(['church_id' => auth()->user()->member->church_id])->get();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'error', 'message' => 'Requisition disapproved']);
    }
}
