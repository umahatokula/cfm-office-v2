<?php

namespace App\Http\Livewire\Accounting\Requisitions;

use Livewire\Component;
use App\Models\Requisition;

class ShowRequisition extends Component
{
    public function render()
    {
        return view('livewire.accounting.requisitions.show-requisition');
    }

    public function mount(Requisition $requisition) {
        $this->requisition = $requisition;
    }
}
