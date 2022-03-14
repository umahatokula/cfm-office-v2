<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\StaffBankDetail;
use App\Http\Requests\StoreStaffBankDetailRequest;

class StaffBankDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Staff $staff)
    {
        $data['staff'] = $staff;
        $data['banks'] = Bank::all();

        return view('pages.staffBankDetails.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffBankDetailRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffBankDetail  $staffBankDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StaffBankDetail $staffBankDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffBankDetail  $staffBankDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffBankDetail $staffBankDetail, Staff $staff)
    {
        $data['staff'] = $staff;
        $data['banks'] = Bank::all();
        $data['staffBankDetail'] = $staffBankDetail;

        return view('pages.staffBankDetails.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffBankDetail  $staffBankDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffBankDetail $staffBankDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffBankDetail  $staffBankDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffBankDetail $staffBankDetail)
    {
        //
    }
}
