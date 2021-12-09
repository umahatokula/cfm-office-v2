<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FirstTimer;
use App\Models\AgeProfile;
use App\Models\Title;
use App\Models\MaritalStatus;
use App\Models\State;
use App\Models\ServiceType;
use App\Models\Member;

class FirstTimersController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['firstTimersMenu'] = 1;
        $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');

        $q = FirstTimer::query();

        if (request('age_profile_id')) {
            $q->orWhere('age_profile_id', '=', $request->age_profile_id);
        }

        if (request('guest_name')) {

            $unique_id = substr(request('guest_name'), -7);

            if (is_int($unique_id)) {
                $q->orWhere('unique_id', 'like', "%".$unique_id."%");
            } else {
               $q->orWhere('name', 'like', "%".request('guest_name')."%");
            }

        }

        if (request('inviter_name')) {
            $q->orWhere('guest_of', 'like', "%".request('inviter_name')."%");
        }

        if (request('status_id')) {
            $q->orWhere('status_id', '=', request('status_id'));
        }

        $data['firstTimers'] = $q->get();

        return view('first-timers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['firstTimersMenu'] = 1;
        $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');
        $data['titles'] = Title::pluck('title', 'id');
        $data['maritalStatuses'] = MaritalStatus::pluck('marital_status', 'id');
        $data['states'] = State::pluck('name', 'id');
        $data['serviceTypes'] = ServiceType::pluck('service_type', 'id');
        $data['noOfVisits'] = ['1_time' => '1st Time', '2_time' => '2nd Time', '3_time' => '3rd Time', 'member' => 'Member'];
        $data['hearAboutUs'] = ['brochure' => 'Brochure', 'online' => 'Online', 'drive_by' => 'Drive By', 'friend' => 'Friend', 'handbill' => 'Publicity Handbill/Poster', 'radio_tv' => 'Radio/TV', 'other' => 'Other'];
        $data['interests'] = [
        'recieving_jesus' => 'Recieving Jesus as my Saviour', 
        'joining_cfc' => 'Joining Christ Family Center', 
        'baptism' => 'Baptism', 
        'discipleship' => 'Discipleship', 
        'growing_spiritually' => 'Growing Spiritually', 
        'join_team' => 'Joiing a TEAM'];
        $data['moreInfo'] = [
        'partnership' => 'Partnership', 
        'products' => 'Products', 
        'mission_outreach' => 'Mission and Outreach', 
        'event_programme' => 'Upcoming Event/Programme'];

        return view('first-timers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $rules = [
        'service_type_id'   => 'required',
        'service_date'      => 'required',
        'is_new'            => 'required',
        'name'              => 'required',
        'is_first_timer'    => 'required',
        'phone_home'        => 'required',
        'no_of_visits'      => 'required',
        'guest_of'          => 'required',
        'marital_status_id' => 'required',
        'age_profile_id'    => 'required',
        'hear_about_us'     => 'required',
        ];

        $messages = [
        'service_type_id.required'   => 'Choose service type',
        'service_date.required'      => 'Choose service date',
        'is_new.required'            => 'New or Updating information',
        'name.required'              => 'Your name is required',
        'phone_home.required'        => 'Please give us a phone number',
        'is_first_timer.required'    => 'First Time or Returning Guest',
        'age_profile_id.required'    => 'Age profile is required',
        'guest_of.required'          => 'You are a guest of',
        'no_of_visits.required'      => 'Is this your 1st, 2nd, 3rd visit?',
        'hear_about_us.required'     => 'How did you hear about us',
        'marital_status_id.required' => 'Select your marital status',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }
            return \Redirect::back()->withInput()->withErrors($validator);

        }



        if ($request->guest_of_hidden) {
            $unique_id = substr($request->guest_of, -7);
            $inviter = Member::where('unique_id',  $unique_id)->first();
        }

        $firstTimer = new FirstTimer;
        $firstTimer->church_id          = \Auth::user()->member->church_id;
        $firstTimer->unique_id          = $firstTimer->generateUniqueId();
        $firstTimer->service_type_id    = $request->service_type_id;
        $firstTimer->service_date       = $request->service_date;
        $firstTimer->is_new             = $request->is_new;
        $firstTimer->title_id           = $request->title_id;
        $firstTimer->name               = $request->name;
        $firstTimer->is_first_timer     = $request->is_first_timer;
        $firstTimer->address            = $request->address;
        $firstTimer->prayer_request     = $request->prayer_request;
        $firstTimer->state_id           = $request->state_id;
        $firstTimer->phone_home         = $request->phone_home;
        $firstTimer->phone_office       = $request->phone_office;
        $firstTimer->no_of_visits       = $request->no_of_visits;
        if (isset($inviter)) {
            $firstTimer->member_id      = $inviter->id;
            $firstTimer->inviter_is_member       = 1;
            $firstTimer->guest_of       = $inviter->fname.' '.$inviter->mname.' '.$inviter->lname;
        } else {
            $firstTimer->guest_of       = $request->guest_of;
        }
        $firstTimer->marital_status_id  = $request->marital_status_id;
        $firstTimer->age_profile_id     = $request->age_profile_id;
        $firstTimer->no_of_children     = $request->no_of_children;
        $firstTimer->children_names     = $request->children_names;
        $firstTimer->hear_about_us      = $request->hear_about_us;
        $firstTimer->interested_in      = $request->interested_in;
        $firstTimer->more_info          = $request->more_info;
        $firstTimer->status_id             = 12;
        $firstTimer->save();

        return ['success' => true, 'message' =>'First Time Guest record created', 'firstTimer' => $firstTimer];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['firstTimersMenu'] = 1;
        $data['ageProfiles'] = AgeProfile::pluck('age_profile', 'id');
        $data['titles'] = Title::pluck('title', 'id');
        $data['maritalStatuses'] = MaritalStatus::pluck('marital_status', 'id');
        $data['states'] = State::pluck('name', 'id');
        $data['serviceTypes'] = ServiceType::pluck('service_type', 'id');
        $data['noOfVisits'] = ['1_time' => '1st Time', '2_time' => '2nd Time', '3_time' => '3rd Time', 'member' => 'Member'];
        $data['hearAboutUs'] = ['brochure' => 'Brochure', 'online' => 'Online', 'drive_by' => 'Drive By', 'friend' => 'Friend', 'handbill' => 'Publicity Handbill/Poster', 'radio_tv' => 'Radio/TV', 'other' => 'Other'];
        $data['interests'] = [
        'recieving_jesus' => 'Recieving Jesus as my Saviour', 
        'joining_cfc' => 'Joining Christ Family Center', 
        'baptism' => 'Baptism', 
        'discipleship' => 'Discipleship', 
        'growing_spiritually' => 'Growing Spiritually', 
        'join_team' => 'Joiing a TEAM'];
        $data['moreInfo'] = [
        'partnership' => 'Partnership', 
        'products' => 'Products', 
        'mission_outreach' => 'Mission and Outreach', 
        'event_programme' => 'Upcoming Event/Programme'];
        $data['firstTimer'] = FirstTimer::find($id);

        return view('first-timers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $rules = [
        'service_type_id'=> 'required',
        'service_date'=> 'required',
        'is_new'      => 'required',
        'name'   => 'required',
        'is_first_timer' => 'required',
        'phone_home' => 'required',
        'no_of_visits' => 'required',
        'guest_of' => 'required',
        'marital_status_id' => 'required',
        'age_profile_id' => 'required',
        'hear_about_us' => 'required',
        ];

        $messages = [
        'service_type_id.required'=> 'Choose service type',
        'service_date.required'=> 'Choose service date',
        'is_new.required'      => 'New or Updating information',
        'name.required'   => 'Your name is required',
        'phone_home.required'   => 'Please give us a phone number',
        'is_first_timer.required'   => 'First Time or Returning Guest',
        'age_profile_id.required' => 'Age profile is required',
        'guest_of.required' => 'You are a guest of',
        'no_of_visits.required' => 'Is this your 1st, 2nd, 3rd visit?',
        'hear_about_us.required' => 'How did you hear about us',
        'marital_status_id.required' => 'Select your marital status',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }
            return \Redirect::back()->withInput()->withErrors($validator);

        }



        if ($request->guest_of_hidden) {
            $unique_id = substr($request->guest_of, -7);
            $inviter = Member::where('unique_id',  $unique_id)->first();
        }

        $firstTimer = FirstTimer::find($id);
        $firstTimer->church_id          = \Auth::user()->member->church_id;
        $firstTimer->service_type_id    = $request->service_type_id;
        $firstTimer->service_date       = $request->service_date;
        $firstTimer->is_new             = $request->is_new;
        $firstTimer->title_id           = $request->title_id;
        $firstTimer->name               = $request->name;
        $firstTimer->is_first_timer     = $request->is_first_timer;
        $firstTimer->address            = $request->address;
        $firstTimer->prayer_request     = $request->prayer_request;
        $firstTimer->state_id           = $request->state_id;
        $firstTimer->phone_home         = $request->phone_home;
        $firstTimer->phone_office       = $request->phone_office;
        $firstTimer->no_of_visits       = $request->no_of_visits;
        if (isset($inviter)) {
            $firstTimer->member_id      = $inviter->id;
            $firstTimer->inviter_is_member       = 1;
            $firstTimer->guest_of       = $inviter->fname.' '.$inviter->mname.' '.$inviter->lname;
        } else {
            $firstTimer->guest_of       = $request->guest_of;
        }
        $firstTimer->marital_status_id  = $request->marital_status_id;
        $firstTimer->age_profile_id     = $request->age_profile_id;
        $firstTimer->no_of_children     = $request->no_of_children;
        $firstTimer->children_names     = $request->children_names;
        $firstTimer->hear_about_us      = $request->hear_about_us;
        $firstTimer->interested_in      = $request->interested_in;
        $firstTimer->more_info          = $request->more_info;
        $firstTimer->status_id             = 12;
        $firstTimer->save();

        return ['success' => true, 'message' =>'First Time Guest record updated', 'firstTimer' => $firstTimer];

        session()->flash('successMessage', 'First Time Guest record updated');
        return redirect('first-timers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {

        $firsttimer = FirstTimer::find($id);
        // dd($member, $id);

        if ($firsttimer) {

            $firsttimer = $firsttimer->delete();

        } else {

            if (\Request::ajax()) {
                return response()->json(['success' => false, 'message' => 'First Timer was not found']);
            }

            session()->flash('errorMessage', 'First Timer was not found.');
            return redirect('first-timers');
        }

        if (\Request::ajax()) {
            return response()->json(['success' => true, 'message' => 'First Timer deleted']);
        }

        session()->flash('successMessage', 'First Timer deleted.');
        return redirect('first-timers');

    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function autocomplete(Request $request)
    {
        // dd($request->all());
        return FirstTimer::search($request->get('q'))->where('church_id', \Auth::user()->member->church_id)->get();
    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request) {
        // dd($request->all());

        $q = FirstTimer::query();

        if ($request->age_profile_id) {
            $q->orWhere('age_profile_id', '=', $request->age_profile_id);
        }

        if ($request->guest_name) {

            $unique_id = substr($request->guest_name, -7);

            if ($unique_id) {
                $q->orWhere('unique_id', 'like', "%".$unique_id."%");
            } else {
               $q->orWhere('name', 'like', "%".$request->guest_name."%");  
            }

        }

        if ($request->inviter_name) {
            $q->orWhere('guest_of', 'like', "%".$request->inviter_name."%");
        }

        if ($request->status_id) {
            $q->orWhere('status_id', '=', $request->status_id);
        }

        $data['firstTimers'] = $q->get();

        return view('first-timers.search-results', $data);
    }
}
