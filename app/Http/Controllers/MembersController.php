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

    	return view('frontend.pages.members.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    	return view('frontend.pages.members.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    	return view('frontend.pages.members.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    	return view('frontend.pages.members.edit');
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
