<?php

namespace App\Http\Livewire\Salary;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Salary;
use Livewire\Component;
use App\Models\SalarySchedule;

class NewSalarySchedule extends Component
{
    public  $salaryMonth,
            $salaryYear,
            $lastSalarySchedule, 
            $staffs, 
            $salarySchedulesForTheMonth,
            $bank,
            $salary_schedule_id,
            $scheduleComponentsElements,
            $salarySchedule;
    
    protected  $months;

    public $rules = [
        'salaryMonth' => 'required',
        'salary_schedule_id' => 'required',
    ];

    public $messages = [
        'salaryMonth.required' => 'This field is required',
        'salary_schedule_id.required' => 'This field is required',
    ];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {

        $this->salaryMonth = Carbon::now()->format('m');

        $this->salaryYear = date('Y');

        $this->salarySchedules = SalarySchedule::all();
    }
    
    /**
     * mount
     *
     * @return void
     */
    public function onSelectSalarySchedule() {

        $this->validate();

        $this->staffs = Staff::with('bankDetails.bank')->get();
        $this->salarySchedule = SalarySchedule::where('id', $this->salary_schedule_id)->with('scheduleComponents')->first();

        $this->salarySchedulesForTheMonth = [];
        foreach ($this->staffs as $key => $staff) {
            if ($this->salarySchedule) {
                foreach ($this->salarySchedule->scheduleComponents as $k => $scheduleComponent) {
                    $this->salarySchedulesForTheMonth[$key][$scheduleComponent->salaryScheduleElement->name] = $this->calAmount($staff->gross_salary, $scheduleComponent->percentage);
                }
            }
        }

        $this->scheduleComponentsElements = $this->salarySchedule->scheduleComponents->map(function($item) {
            return $item->salaryScheduleElement ? $item->salaryScheduleElement->name : null;
        })->toArray();
        
    }
    
    /**
     * saveSalarySchedule
     *
     * @return void
     */
    public function saveSalaries() {

        foreach ($this->staffs as $key => $staff) {

            if (!empty($this->salarySchedulesForTheMonth)) {

                // add gross salary to array
                $this->salarySchedulesForTheMonth[$key]['gross_salary'] = $staff->gross_salary;
                $this->salarySchedulesForTheMonth[$key]['bank_name'] = $staff->primaryBankDetails() ? ($staff->primaryBankDetails()->bank ? $staff->primaryBankDetails()->bank->name : null) : null;
                $this->salarySchedulesForTheMonth[$key]['account_number'] = $staff->primaryBankDetails() ? $staff->primaryBankDetails()->account_number : null;
                $this->salarySchedulesForTheMonth[$key]['account_name'] = $staff->primaryBankDetails() ? $staff->primaryBankDetails()->account_name : null;

                $salary = Salary::updateOrCreate(
                    [
                        'month_of_salary'    => $this->salaryMonth,
                        'year_of_salary'     => $this->salaryYear,
                        'salary_schedule_id' => $this->salary_schedule_id,
                        'staff_id'           => $staff->id
                    ],
                    [
                        'breakdown' => $this->salarySchedulesForTheMonth[$key],
                    ]
                );

            }
        }

        session()->flash('message', 'Salary Schedule saved');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Salary Schedule saved']);

        redirect()->route('salaries.staff.preview', [$this->salaryMonth, $this->salaryYear, $this->salary_schedule_id]);
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
