<?php

namespace App\Exports;

use App\Models\Salary;
use App\Models\SalarySchedule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalaryScheduleExport implements FromView
{
    public $month_of_salary, $year_of_salary, $salary_schedule_id;

    public function __construct($month_of_salary, $year_of_salary, $salary_schedule_id) {
        $this->month_of_salary = $month_of_salary;
        $this->year_of_salary = $year_of_salary;
        $this->salary_schedule_id = $salary_schedule_id;
    }

    public function view(): View {

        $salarySchedule = SalarySchedule::where('id', $this->salary_schedule_id)->with('scheduleComponents.salaryScheduleElement')->first();

        if (!$salarySchedule) {
            abort(404);
        }
        $salaries = Salary::where(['month_of_salary' => $this->month_of_salary, 'salary_schedule_id' => $this->salary_schedule_id])->get();

        $scheduleComponentsElements = $salarySchedule->scheduleComponents->map(function($item) {
            return $item->salaryScheduleElement ? $item->salaryScheduleElement->name : null;
        })->toArray();

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

        return view('exports.salarySchedule', [
            'month_of_salary'            => $this->month_of_salary,
            'year_of_salary'             => $this->year_of_salary,
            'salarySchedule'             => $salarySchedule,
            'scheduleComponentsElements' => $scheduleComponentsElements,
            'salaries'                   => $salaries,
            'months'                     => $months,
        ]);
    }

}
