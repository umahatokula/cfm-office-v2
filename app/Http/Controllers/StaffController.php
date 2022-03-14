<?php

namespace App\Http\Controllers;

use App\Helpers\Sms;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.staff.create');
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
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $data['staff'] = $staff;
        return view('pages.staff.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $data['staff'] = $staff;
        return view('pages.staff.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
    
    /**
     * notify
     *
     * @param  mixed $staff
     * @return void
     */
    public function notify(Staff $staff) {
        $data['staff'] = $staff;
        
        return view('pages.staff.notify', $data);
    }
    
    /**
     * notifyPost
     *
     * @param  mixed $request
     * @return void
     */
    public function notifyPost(Request $request) {
        // dd($request->all());

        $rules = [
            'sms' => 'required_without:email',
            'email' => 'required_without:sms',
            'message' => 'required',
        ];
    
        $messages = [
            'sms.required_without' => 'Either SMS or Email must be checked',
            'email.required_without' => 'Either SMS or Email must be checked',
            'message.required' => 'Enter a message',
        ];

        $this->validate($request, $rules, $messages);

        $staff = Staff::findOrFail($request->staff_id);

        // send SMS
        if ($request->has('sms')) {        
            if ($staff->phone) {

                $response = Sms::sendSMSMessage($staff->phone, $request->message);
                // dd($response);

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return redirect()->back();
                }

            }
        }
        

        // send whatsapp
        if ($request->has('whatsapp')) {        
            if ($staff->phone) {

                Sms::sendWhatsAppMessage($staff->phone, $request->message);

            }
        }
        

        // send email
        if ($request->has('email')) {
            if ($staff->email) {
                Mail::to($staff->email)
                ->send(new CustomMailable($request->subject, $request->message));
            }
        }

        session()->flash('message', 'Notification sent to staff');
        return redirect()->back();
        
    }
}
