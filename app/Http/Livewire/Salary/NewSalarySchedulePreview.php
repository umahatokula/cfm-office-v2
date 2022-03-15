<?php

namespace App\Http\Livewire\Salary;

use App\Models\Salary;
use Livewire\Component;
use App\Models\SalarySchedule;

class NewSalarySchedulePreview extends Component
{

    public $month_of_salary, $year_of_salary, $salary_schedule_id;
    public $salaries, $salarySchedule, $scheduleComponentsElements;
    
    protected  $months;
    
    /**
     * mount
     *
     * @param  mixed $salary
     * @return void
     */
    public function mount($month_of_salary, $year_of_salary, $salary_schedule_id) {
        $this->month_of_salary = $month_of_salary;
        $this->year_of_salary = $year_of_salary;
        $this->salary_schedule_id = $salary_schedule_id;

        $this->salarySchedule = SalarySchedule::where('id', $salary_schedule_id)->with('scheduleComponents.salaryScheduleElement')->first();
        if (!$this->salarySchedule) {
            abort(404);
        }
        $this->salaries = Salary::where(['month_of_salary' => $this->month_of_salary, 'salary_schedule_id' => $this->salary_schedule_id])->get();

        $this->scheduleComponentsElements = $this->salarySchedule->scheduleComponents->map(function($item) {
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
