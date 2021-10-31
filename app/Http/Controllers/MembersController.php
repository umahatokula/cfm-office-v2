<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\Gender;
use App\Models\AgeProfile;
use App\Models\Country;
use App\Models\Member;
use App\Models\Local;
use App\Models\Church;
use App\Models\Cell;
use App\Models\ServiceTeam;
use App\Models\Region;
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

    	$data['title'] = 'Everyone';
    	$data['manage_members'] = 1;

        $data['members'] = Member::all();        
        $data['churches'] = Church::all();        

    	return view('frontend.pages.members.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['title']          = 'Add New Member';
        $data['manage_members'] = 1;
        $data['gender']         = Gender::pluck('gender', 'id');
        $data['ageProfiles']    = AgeProfile::pluck('age_profile', 'id');
        $data['states']         = State::pluck('name', 'id');
        $data['locals']         = Local::orderBy('local_name', 'asc')->pluck('local_name', 'id');
        $data['countries']      = Country::orderBy('name', 'asc')->pluck('name', 'id');
        $data['churches']       = Church::pluck('name', 'id');
        $data['cells']          = Cell::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['serviceTeams']   = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['regions']        = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');

        $days = [];
        for ($i=1; $i <= 31; $i++) { 
            $days[] = $i;
        }
        $data['days'] = $days ;

        $months = [];
        for ($i=1; $i <= 12; $i++) { 
            $months[] = $i;
        }
        $data['months'] = $months ;

    	return view('frontend.pages.members.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->all());

        //only do this if a picture is uploaded
    	$path = '';

    	if($request->file('picture')) {

            // check file size
    		$file_size = $request->file('picture')->getClientSize();
    		if ($file_size > 1000000) {

    			if ($request->ajax()) {
    				return response()->json(['success' => true, 'message' => 'Uploaded image must not be greater than 1MB' ]);
    			}

    			session()->flash('errorMessage', 'Uploaded image must not be greater than 1MB');
    			return redirect()->back()->withInput($request->except('scheduleTitle', 'scheduleStartTime', 'scheduleEndTime'))->withErrors($validator);
    		}

            //upload
    		$path = $request->file('picture')->store('members', 'uploads');
    	}

        $dob = null;
        $day = 01;
        $month = 01;
        $year = 1900;

        if (($request->has('day') || $request->has('month') || $request->has('year'))) {
            
            if ($request->day) {
                $day = $request->day;
            }
            
            if ($request->month) {
                $month = $request->month;
            }
            
            if ($request->year) {
                $year = $request->year;
            }
            $dob = $month.'/'.$day.'/'.$year;
        }

        $phone = $request->phone;
        $phone = str_replace('/', ',', $phone);
        $phone = str_replace(' ', ',', $phone);
        $phone = str_replace('-', ',', $phone);
        

        $member                 = new Member;
        $member->unique_id      = $member->generateUniqueId(); 
        $member->fname          = $request->fname; 
        $member->lname          = $request->lname;   
        $member->mname          = $request->mname;
        $member->full_name      = $request->fname.' '.$request->mname.' '.$request->lname;
        $member->email          = $request->email; 
        $member->address        = $request->address;    
        $member->phone          = $phone;
        $member->occupation     = $request->occupation;
        $member->gender_id      = $request->gender_id;
        $member->country_id     = $request->country_id;
        $member->state_id       = $request->state_id; 
        $member->local_id       = $request->local_id;  
        $member->cell_id        = $request->cell_id;  
        $member->dob            = $dob; 
        $member->age_profile_id = $request->age_profile_id;
        $member->facebook       = $request->facebook;
        $member->whatsapp       = $request->whatsapp;
        $member->twitter        = $request->twitter;
        $member->instagram      = $request->instagram;
        $member->picture_path   = $path;
        $member->church_id      = $request->church_id; 
        $member->region_id      = $request->region_id;
        $member->marital_id     = $request->marital_id;
        $member->save();

    	return redirect('members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
    	$data['profile'] = Member::find($id);
        // dd($data['profile']);

    	if (empty($data['profile'])) {
    		return redirect('error');
    	}


    	$data['title'] = $data['profile']->fname;
    	$data['manage_members'] = 1;

    	return view('frontend.pages.members.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['member']         = Member::find($id);
        $data['title']          = 'Add New Member';
        $data['manage_members'] = 1;
        $data['gender']         = Gender::pluck('gender', 'id');
        $data['ageProfiles']    = AgeProfile::pluck('age_profile', 'id');
        $data['states']         = State::pluck('name', 'id');
        $data['locals']         = Local::orderBy('local_name', 'asc')->pluck('local_name', 'id');
        $data['countries']      = Country::pluck('name', 'id');
        $data['churches']       = Church::pluck('name', 'id');
        $data['cells']          = Cell::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['serviceTeams']   = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['regions']        = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');

        $days = [];
        for ($i=1; $i <= 31; $i++) { 
            $days[$i] = $i;
        }
        $data['days'] = $days ;

        $months = [];
        for ($i=1; $i <= 12; $i++) { 
            $months[$i] = $i;
        }
        $data['months'] = $months ;

    	return view('frontend.pages.members.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    	$member = Member::findOrFail($id);

        //only do this if a picture is uploaded
    	$path = $member->picture_path ;

    	if($request->file('picture')) {

            // check file size
    		$file_size = $request->file('picture')->getClientSize();
    		if ($file_size > 1000000) {
    			return redirect()->back()->withInput($request->except('scheduleTitle', 'scheduleStartTime', 'scheduleEndTime'))->withErrors($validator);
    		}

            //upload
    		$path = $request->file('picture')->store('members', 'uploads');
    	}

        $dob = null;
        $day = 01;
        $month = 01;
        $year = 1900;

        if (($request->day || $request->month || $request->year)) {
            
            if ($request->day) {
                $day = $request->day;
            }

            
            if ($request->month) {
                $month = $request->month;
            }

            
            if ($request->year) {
                $year = $request->year;
            }
            $dob = $month.'/'.$day.'/'.$year;
        }

        $phone = $request->phone;
        $phone = str_replace('/', ',', $phone);
        $phone = str_replace(' ', ',', $phone);
        $phone = str_replace('-', ',', $phone);


        $member->unique_id      = $member->generateUniqueId(); 
        $member->fname          = $request->fname;  
        $member->lname          = $request->lname;   
        $member->mname          = $request->mname;
        $member->full_name      = $request->fname.' '.$request->mname.' '.$request->lname;
        $member->email          = $request->email; 
        $member->address        = $request->address;    
        $member->phone          = $phone;
        $member->occupation     = $request->occupation;
        $member->gender_id      = $request->gender_id;
        $member->country_id     = $request->country_id;
        $member->state_id       = $request->state_id; 
        $member->local_id       = $request->local_id; 
        $member->cell_id        = $request->cell_id;  
        $member->church_id      = $request->church_id; 
        $member->region_id      = $request->region_id;
        $member->marital_id     = $request->marital_id; 
        $member->dob            = $dob;
        $member->age_profile_id = $request->age_profile_id;
        $member->facebook       = $request->facebook;
        $member->whatsapp       = $request->whatsapp;
        $member->twitter        = $request->twitter;
        $member->instagram      = $request->instagram;
        $member->picture_path   = $path;
        $member->save();

    	return redirect()->route('members.show', $member->id);

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
        
    	$member = Member::findOrFail($id);

        $member->user()->delete();
        $member->delete();

        return redirect('members');

    }

    /**
     * show members's picture
     * @param  [type] $id int
     * @return [type]     [description]
     */
    public function getPicture($id) {

    	$member = Member::findOrFail($id);

        $path = '';
        
        if ($member->picture_path) {
            $path = storage_path('app') .'/' . $member->picture_path;
        } else {
            $path = storage_path('app') .'/members/no-photo.png';
        }

    	$file = \File::get($path);
    	$type = \File::mimeType($path);

    	return \Response::make($file,200)->header("Content-Type", $type);
    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request) {
        return Member::search($request->get('q'))->where('church_id', \Auth::user()->member->church_id)->get();
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
}
