<?php

namespace App\Http\Controllers;

use App\Models\SalarySchedule;
use Illuminate\Http\Request;

class SalaryScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['schedules'] = SalarySchedule::active()->paginate(20);

        return view('pages.salariesSchedules.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['schedulesElements'] = SalarySchedule::active()->paginate(20);

        return view('pages.salariesSchedules.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalarySchedule  $salarySchedule
     * @return \Illuminate\Http\Response
     */
    public function show(SalarySchedule $salarySchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalarySchedule  $salarySchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarySchedule $salarySchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalarySchedule  $salarySchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalarySchedule $salarySchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalarySchedule  $salarySchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalarySchedule $salarySchedule)
    {
        //
    }
}
