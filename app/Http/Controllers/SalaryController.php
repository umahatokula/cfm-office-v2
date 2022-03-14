<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Salary;
use Illuminate\Http\Request;

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
}
