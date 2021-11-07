<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceTeam;
use App\Models\Member;
use App\Models\MemberServiceTeam;

class ServiceTeamsController extends Controller
{
    protected $currentUser;

    function __constructor() {
        $this->middleware('auth');

        $this->currentUser = \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['serviceTeamsMenu'] = 1;
        $data['serviceTeams'] = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->get();
        $data['members'] = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');

        return view('service-teams.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
        'name'          => 'required',
        'description'   => 'required',
        'leader'        => 'required'
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $serviceTeam = new ServiceTeam;
        $serviceTeam->name           = $request->name;  
        $serviceTeam->description    = $request->description;   
        $serviceTeam->leader         = $request->leader;
        $serviceTeam->church_id      = \Auth::user()->member->church_id;
        $serviceTeam->save();


        session()->flash('successMessage', "Service Team added");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Service Team added.' ]);
        }

        return redirect('service-teams');
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
        $data['serviceTeamsMenu'] = 1;
        $data['serviceTeams'] = ServiceTeam::all();
        $data['members'] = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
        $data['serviceTeam'] = ServiceTeam::find($id);


        return view('service-teams.edit', $data);
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
        // dd($request);
        $rules = [
        'name'          => 'required',
        'description'   => 'required',
        'leader'        => 'required'
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $serviceTeam = ServiceTeam::find($id);
        $serviceTeam->name           = $request->name;  
        $serviceTeam->description    = $request->description;   
        $serviceTeam->leader         = $request->leader;
        $serviceTeam->save();


        session()->flash('successMessage', "Service Team edited");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Service Team edited.' ]);
        }

        return redirect('service-teams');
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
    public function delete($id)
    {
        $serviceTeam = ServiceTeam::find($id);

        if ($serviceTeam) {
            $serviceTeam = $serviceTeam->delete();

        } else {

            if (\Request::ajax()) {
                return response()->json(['message' => 'Service Team was not found']);
            }

            session()->flash('errorMessage', 'Service Team was not found.');
            return redirect()->back();
        }

        if (\Request::ajax()) {
            return response()->json(['message' => 'Service Team deleted']);
        }

        session()->flash('successMessage', 'Service Team deleted.');
        return redirect()->back();

    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        return ServiceTeam::search($request->get('q'))->get();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suggest($member_id)
    {
        $member = Member::find($member_id);

        $data['myServiceTeams'] = MemberServiceTeam::where('member_id', $member->id)->pluck('service_team_id')->toArray();

        $data['serviceTeams'] = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->get();

        $data['member'] = $member;

        return view('service-teams.suggest', $data);

    }
}
