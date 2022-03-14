<?php

namespace App\Http\Livewire\Staff;

use App\Models\Staff;
use Livewire\Component;

class ShowStaff extends Component
{
    public Staff $staff;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(Staff $staff) {
        $this->staff = $staff;
    }

    public function render()
    {
        return view('livewire.staff.show-staff');
    }
}
