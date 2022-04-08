<?php

namespace App\Http\Livewire\Salary;

use App\Models\Salary;
use Livewire\Component;
use App\Models\SalarySchedule;

class NewSalaryPreview extends Component
{

    public $salaryId;
    public $salary, $salaries, $salarySchedule, $scheduleDetailsElements;

    protected  $months;

    /**
     * mount
     *
     * @param  mixed $salary
     * @return void
     */
    public function mount($salaryId) {

        $this->salaryId = $salaryId;
        $this->salary = Salary::find($salaryId);
        $this->salaries = $this->salary->salaryDetails;

        $this->salarySchedule = SalarySchedule::where('id', $this->salary->salary_schedule_id)->with('scheduleDetails.salaryScheduleElement')->first();
        if (!$this->salarySchedule) {
            abort(404);
        }

        $this->scheduleDetailsElements = $this->salarySchedule->scheduleDetails->map(function($item) {
            return $item->salaryScheduleElement ? $item->salaryScheduleElement->name : null;
        })->toArray();
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

        return view('livewire.salary.new-salary-schedule-preview', [
            'months' => $months
        ]);
    }
}
