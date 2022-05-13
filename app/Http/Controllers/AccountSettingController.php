<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Http\Requests\StoreAccountSettingRequest;
use App\Http\Requests\UpdateAccountSettingRequest;
use App\Models\ChartOfAccount;

class AccountSettingController extends Controller
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
    public function create()
    {
        $data['coas'] = ChartOfAccount::all();

        return view('accounting.coa.account-setting', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSetting $accountSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountSetting $accountSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountSettingRequest  $request
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountSettingRequest $request, AccountSetting $accountSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountSetting $accountSetting)
    {
        //
    }
}
