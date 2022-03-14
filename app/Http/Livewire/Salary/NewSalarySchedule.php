<?php

namespace App\Http\Livewire\Salary;

use App\Models\Staff;
use App\Models\Salary;
use Livewire\Component;
use App\Models\SalarySchedule;

class NewSalarySchedule extends Component
{
    public  $salaryMonth, 
            $lastSalarySchedule, 
            $staffs, 
            $salarySchedulesForTheMonth,
            $bank;
    
    protected  $months;
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {

        $this->staffs = Staff::with('bankDetails.bank')->get();
        $this->lastSalarySchedule = SalarySchedule::with('scheduleComponents')->latest('created_at')->first();

        $this->salarySchedulesForTheMonth = [];
        foreach ($this->staffs as $key => $staff) {
            if ($this->lastSalarySchedule) {
                foreach ($this->lastSalarySchedule->scheduleComponents as $k => $scheduleComponent) {
                    $this->salarySchedulesForTheMonth[$key][$scheduleComponent->salaryScheduleElement->name] = $this->calAmount($staff->gross_salary, $scheduleComponent->percentage);
                }
            }
        }
        // dd($this->salarySchedulesForTheMonth);

        $this->salaryMonth = now()->format('m');
    }
    
    /**
     * saveSalarySchedule
     *
     * @return void
     */
    public function saveSalaries() {
        foreach ($this->staffs as $key => $staff) {
            dd($staff->primaryBankDetails);
            if (!empty($this->salarySchedulesForTheMonth)) {

                // add gross salary to array
                $this->salarySchedulesForTheMonth[$key]['gross_salary'] = $staff->gross_salary;
                $this->salarySchedulesForTheMonth[$key]['banke_name'] = $staff->bankDetails->bank->name;
                $this->salarySchedulesForTheMonth[$key]['account_number'] = $staff->bankDetails->account_number;
                $this->salarySchedulesForTheMonth[$key]['account_name'] = $staff->bankDetails->account_name;
                dd($this->salarySchedulesForTheMonth[$key]);

                $salary = Salary::updateOrCreate(
                    [
                        'month_of_salary' =>  $this->salaryMonth,
                        'staff_id' => $staff->id
                    ],
                    [
                        'breakdown' => $this->salarySchedulesForTheMonth[$key],
                    ]
                );

            }
        }

        session()->flash('message', 'Salary Schedule saved');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Salary Schedule saved']);
    }
    
    /**
     * calAmount
     *
     * @param  mixed $amount
     * @param  mixed $percentage
     * @return void
     */
    public function calAmount($amount, $percentage) {
        return $amount * ($percentage / 100);
    }

    public function render()
    {

        $months = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        return view('livewire.salary.new-salary-schedule', [
            'months' => $months
        ]);
    }
}
