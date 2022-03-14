<?php

namespace App\Http\Livewire\StaffBankDetails;

use App\Models\Bank;
use App\Models\Staff;
use Livewire\Component;
use App\Models\StaffBankDetail;

class Create extends Component
{

    public Staff $staff;
    public $banks, $staff_name, $staff_id, $bank_id, $account_number, $account_name, $is_primary;

    public $rules = [
        'staff_id' => 'required',
        'bank_id' => 'required',
        'account_number' => 'required',
        'account_name' => 'required',
        // 'is_primary' => 'required',
    ];

    public $messages = [
        'staff_id.required' => 'This field is required',
        'bank_id.required' => 'This field is required',
        'account_number.required' => 'This field is required',
        'account_name.required' => 'This field is required',
        'is_primary.required' => 'This field is required',
    ];
    
    /**
     * mount
     *
     * @param  mixed $staff
     * @return void
     */
    public function mount(Staff $staff) {
        
        $this->staff = $staff;
        $this->staff_name = $staff->name;
        $this->staff_id = $staff->id;
        $this->banks = Bank::all();

    }
    
    /**
     * onEditBankDetails
     *
     * @return void
     */
    public function destroy($id) {

        $staffBankDetail = StaffBankDetail::where('id', $id)->first();

        if ($staffBankDetail->is_primary) {
            session('error', 'Cannot delete the primary account');
            return;
        }
        
        $staffBankDetail->delete();

        redirect()->route('staff.bankDetails', $this->staff);

    }
    
    /**
     * save
     *
     * @return void
     */
    public function save() {
        $this->validate();

        // if incoming request is_primary, set all other bank details is_primary = false. There can be only one is_primary
        if ($this->is_primary) {
            StaffBankDetail::where('staff_id', $this->staff_id)->update([
                'is_primary' => false,
            ]);
        }

        StaffBankDetail::create([
            'staff_id'       => $this->staff_id,
            'bank_id'        => $this->bank_id,
            'account_number' => $this->account_number,
            'account_name'   => $this->account_name,
            'is_primary'     => $this->is_primary,
        ]);

        return redirect()->route('staff.show', $this->staff);
    }

    public function render()
    {
        return view('livewire.staff-bank-details.create');
    }
}
