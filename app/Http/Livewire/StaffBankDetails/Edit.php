<?php

namespace App\Http\Livewire\StaffBankDetails;

use App\Models\Bank;
use App\Models\Staff;
use Livewire\Component;
use App\Models\StaffBankDetail;

class Edit extends Component
{

    public Staff $staff;
    public StaffBankDetail $staffBankDetail;

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
    public function mount(StaffBankDetail $staffBankDetail, Staff $staff) {

        $this->staff = $staff;
        $this->staffBankDetail = $staffBankDetail;

        $this->staff_name = $staff->name;
        $this->staff_id = $staff->id;
        $this->bank_id = $staffBankDetail->bank_id;
        $this->account_number = $staffBankDetail->account_number;
        $this->account_name = $staffBankDetail->account_name;
        $this->is_primary = $staffBankDetail->is_primary;

        $this->banks = Bank::all();

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

        StaffBankDetail::where('id', $this->staffBankDetail->id)->update([
            'staff_id'       => $this->staff_id,
            'bank_id'        => $this->bank_id,
            'account_number' => $this->account_number,
            'account_name'   => $this->account_name,
            'is_primary'     => $this->is_primary,
        ]);

        return redirect()->route('staff.bankDetails', $this->staff);
    }

    public function render()
    {
        return view('livewire.staff-bank-details.edit');
    }
}
