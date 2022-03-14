<?php

namespace App\Http\Controllers;

use App\Helpers\Sms;

use App\Models\Cell;
use App\Models\Role;
use App\Models\User;
use App\Models\Local;
use App\Models\State;
use App\Models\Church;
use App\Models\Gender;
use App\Models\Member;
use App\Models\Region;
use App\Models\Country;
use App\Models\AgeProfile;
use App\Models\ServiceTeam;
use Illuminate\Http\Request;
use App\Models\MemberServiceTeam;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    	$this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {      

    	return view('pages.members.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    	return view('pages.members.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $data['member'] = $member;

    	return view('pages.members.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $data['member'] = $member;

    	return view('pages.members.edit', $data);
    }


    /**
     * add a member to a cell
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addToServiceTeam(Request $request) {

        MemberServiceTeam::where('member_id', $request->member_id)->delete();
        
        $member = Member::find($request->member_id);

        for ($i=0; $i < count($request->service_team_id); $i++) { 
            $memberServiceTeam = new MemberServiceTeam;
            $memberServiceTeam->member_id = $request->member_id;
            $memberServiceTeam->service_team_id = $request->service_team_id[$i];
            $memberServiceTeam->church_id = \Auth::user()->member->church_id;
            $memberServiceTeam->save();
        }

        return $member->serviceTeams;
    }
    
    /**
     * notify
     *
     * @param  mixed $staff
     * @return void
     */
    public function notify(Member $member) {
        $data['member'] = $member;
        
        return view('pages.members.notify', $data);
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

        $member = Member::findOrFail($request->member_id);

        // send SMS
        if ($request->has('sms')) {        
            if ($member->phone) {

                $response = Sms::sendSMSMessage($member->phone, $request->message);
                // dd($response);

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return redirect()->back();
                }

            }
        }
        

        // send whatsapp
        if ($request->has('whatsapp')) {        
            if ($member->phone) {

                Sms::sendWhatsAppMessage($member->phone, $request->message);

            }
        }
        

        // send email
        if ($request->has('email')) {
            if ($member->email) {
                Mail::to($member->email)
                ->send(new CustomMailable($request->subject, $request->message));
            }
        }

        session()->flash('message', 'Notification sent to member');
        return redirect()->back();
        
    }
}
