<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Salary;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\SalarySchedule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalaryScheduleExport;

class SalaryController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
        return view('pages.salaries.index');
    }
    
    /**
     * editStaffSalary
     *
     * @return void
     */
    public function editStaffSalary(Staff $staff) {
        return view('');
    }

    public function preview($month_of_salary, $year_of_salary, $salary_schedule_id) {

        $data['month_of_salary'] = $month_of_salary;
        $data['year_of_salary'] = $year_of_salary;
        $data['salary_schedule_id'] = $salary_schedule_id;

        return view('pages.salaries.preview', $data);
    }
    
    /**
     * export salary schedule in xlsx format
     *
     * @param  mixed $month_of_salary
     * @param  mixed $year_of_salary
     * @param  mixed $salary_schedule_id
     * @return void
     */
    public function export($month_of_salary, $year_of_salary, $salary_schedule_id) {

        return Excel::download(new SalaryScheduleExport($month_of_salary, $year_of_salary, $salary_schedule_id), 'salary_schedule.xlsx');
        
    }
    
    /**
     * export salary schedule in pdf format
     *
     * @param  mixed $month_of_salary
     * @param  mixed $year_of_salary
     * @param  mixed $salary_schedule_id
     * @return void
     */
    public function pdf($month_of_salary, $year_of_salary, $salary_schedule_id) {
        
        $data['month_of_salary'] = $month_of_salary;
        $data['year_of_salary']  = $year_of_salary;

        $salarySchedule = SalarySchedule::where('id', $salary_schedule_id)->with('scheduleComponents.salaryScheduleElement')->first();

        if (!$salarySchedule) {
            abort(404);
        }
        $data['salaries'] = Salary::where(['month_of_salary' => $month_of_salary, 'salary_schedule_id' => $salary_schedule_id])->get();

        $data['scheduleComponentsElements'] = $salarySchedule->scheduleComponents->map(function($item) {
            return $item->salaryScheduleElement ? $item->salaryScheduleElement->name : null;
        })->toArray();
        
        $data['salarySchedule'] = $salarySchedule;

        $data['months'] = [
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

        $pdf = PDF::loadView('pdf.salarySchedule', $data);
        return $pdf->download('salary_schedule.pdf');
        
    }
}
