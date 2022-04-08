<?php

namespace App\Exports;

use App\Models\Salary;
use App\Models\SalarySchedule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalaryScheduleExport implements FromView
{
    public $salaryId;

    public function __construct($salaryId) {
        $this->salary = Salary::find($salaryId);
    }

    public function view(): View {

        $salarySchedule = SalarySchedule::where('id', $this->salary->salary_schedule_id)->with('scheduleDetails.salaryScheduleElement')->first();

        if (!$salarySchedule) {
            abort(404);
        }
        $salaries = $this->salary->salaryDetails;

        $scheduleDetailsElements = $salarySchedule->scheduleDetails->map(function($item) {
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
            'month_of_salary'            => $this->salary->month_of_salary,
            'year_of_salary'             => $this->salary->year_of_salary,
            'salarySchedule'             => $salarySchedule,
            'scheduleDetailsElements' => $scheduleDetailsElements,
            'salaries'                   => $salaries,
            'months'                     => $months,
        ]);
    }

}
