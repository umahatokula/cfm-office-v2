<?php

namespace App\Http\Livewire\Accounting\Requisitions;

use Livewire\Component;
use App\Models\Requisition;

class EditRequisition extends Component
{
    public Requisition $requisition;
    public $expenseHeads;
    public $requisitionItems = [];

    protected $rules=[
        'expense_head_id' => 'required', 
        'description'     => 'required', 
        'qty'             => 'required', 
        'unit_cost'       => 'required',
        'total_cost'      => 'required',
    ];


    public function render()
    {
        return view('livewire.accounting.requisitions.edit-requisition');
    }
    
    /**
     * mount
     *
     * @param  mixed $requisition
     * @param  mixed $expenseHeads
     * @return void
     */
    public function mount(Requisition $requisition, $expenseHeads) {
        $this->requisition = $requisition->load('requisitionItems');
        $this->requisitionItems = $requisition->requisitionItems;
        
        // $this->expenseHeads = ExpenseHead::where(['status_id' => 1, 'church_id' => auth()->user()->member->church_id])->pluck('title', 'id');
        $this->expenseHeads = [
            1 => 'Bus Expense',
            2 => 'Internet Data Expense',
            3 => 'Office Stationery',
            4 => 'Misc',
        ];

    }
    
    /**
     * add requisition
     *
     * @return void
     */
    public function addRequisitionItem() {
        $this->requisitionItems[] = [
            'expense_head_id' => null,
            'description' => null,
            'qty' => null,
            'unit_cost' => null,
            'total_cost' => null,
        ];
    }
    
    /**
     * remove requisition
     *
     * @param  mixed $index
     * @return void
     */
    public function removeRequisitionItem($key) {
        array_key_exists($key, $this->requisitionItems) ? array_splice($this->requisitionItems, $key, 1) : null;
    }

    public function save() {
        $total_cost = array_sum(array_column($this->requisitionItems, 'total_cost'));
    
        // ExpenseHead::create($request->all())->save();
        $requisition                     = Requisition::find($this->requisition->id);
        $requisition->requisition_number = $requisition->generateRequisitionNumber();
        $requisition->church_id          = auth()->user()->member->church_id;
        $requisition->requested_amount   = $total_cost;
        $requisition->requisition_by     = auth()->user()->member->id;
        $requisition->save();
        
        $RequisitionItem = [];
        foreach ($this->requisitionItems as $key => $requisitionItem) {
            $RequisitionItem[] = new RequisitionItem([
                'requisition_id'  => $requisition->id,
                'expense_head_id' => $requisitionItem['expense_head_id'],
                'description'     => $requisitionItem['description'],
                'qty'             => $requisitionItem['qty'],
                'unit_cost'       => $requisitionItem['unit_cost'],
                'total_cost'      => $requisitionItem['total_cost'],
             ]);
        }

        $res = $requisition->requisitionItems()->saveMany($RequisitionItem);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Report deleted.']);
        redirect()->route('requisitions.index');
    }
}
