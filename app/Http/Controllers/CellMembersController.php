<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceTeam;
use App\Models\Gender;
use App\Models\CellMember;
use App\Models\CellAttendance;
use App\Models\Cell;
use Carbon\Carbon;

class CellMembersController extends Controller
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
        $data['serviceTeams'] = CellMember::where(['church_id' => \Auth::user()->member->church_id])->get();

        return view('cell-members.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cell_id)
    {
        $data['serviceTeams'] = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['genders'] = Gender::pluck('gender', 'id');
        $data['cell'] = Cell::find($cell_id);

        return view('cell-members.create', $data);
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
        'name'      => 'required',
        'gender_id' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter a name',
            'gender_id.required' => 'Please select the gender',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        // save
        $cellMember                  = new CellMember;
        $cellMember->church_id       = \Auth::user()->member->church_id;
        $cellMember->cell_id         = $request->cell_id;
        $cellMember->name            = $request->name;
        $cellMember->phone           = $request->phone;
        $cellMember->email           = $request->email;
        $cellMember->gender_id       = $request->gender_id;
        $cellMember->dob             = $request->dob;
        $cellMember->occupation      = $request->occupation;
        $cellMember->date_joined     = $request->date_joined;
        $cellMember->service_team_id = $request->service_team_id;
        $cellMember->save();

        // add to cell attendance
        $cellAttendance                 = new CellAttendance;
        $cellAttendance->church_id      = \Auth::user()->member->church_id;
        $cellAttendance->cell_member_id = $cellMember->id;
        $cellAttendance->cell_id        = $request->cell_id;
        $cellAttendance->year           = Carbon::now()->year;
        $cellAttendance->month_id       = Carbon::now()->month;
        $cellAttendance->name           = $request->name;
        $cellAttendance->save();
        


        session()->flash('successMessage', "Cell member added");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cell member added.' ]);
        }

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['cellMember'] = CellMember::find($id);
        $data['serviceTeams'] = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['genders'] = Gender::pluck('gender', 'id');
        $data['cell'] = Cell::where(['church_id' => \Auth::user()->member->church_id])->first();

        return view('cell-members.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['cellMember'] = CellMember::find($id);
        $data['serviceTeams'] = ServiceTeam::where('church_id', \Auth::user()->member->church_id)->pluck('name', 'id');
        $data['genders'] = Gender::pluck('gender', 'id');
        $data['cell'] = Cell::where(['church_id' => \Auth::user()->member->church_id])->first();

        return view('cell-members.edit', $data);
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
        'name'      => 'required',
        'gender_id' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter a name',
            'gender_id.required' => 'Please select the gender',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $cellMember                  = CellMember::find($id);
        $cellMember->church_id       = \Auth::user()->member->church_id;
        $cellMember->cell_id         = $request->cell_id;
        $cellMember->name            = $request->name;
        $cellMember->phone           = $request->phone;
        $cellMember->email           = $request->email;
        $cellMember->gender_id       = $request->gender_id;
        $cellMember->dob             = $request->dob;
        $cellMember->occupation      = $request->occupation;
        $cellMember->date_joined     = $request->date_joined;
        $cellMember->service_team_id = $request->service_team_id;
        $cellMember->save();

        // edit on cell attendance
        $cellAttendance                 = CellAttendance::where('cell_member_id', $cellMember->id)->first();
        $cellAttendance->church_id      = \Auth::user()->member->church_id;
        $cellAttendance->cell_member_id = $cellMember->id;
        $cellAttendance->cell_id        = $request->cell_id;
        $cellAttendance->year           = Carbon::now()->year;
        $cellAttendance->month_id       = Carbon::now()->month;
        $cellAttendance->name           = $request->name;
        $cellAttendance->save();


        session()->flash('successMessage', "Cell member edited");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cell member edited.' ]);
        }

        return redirect()->back();
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
        $member = CellMember::find($id);

        if ($member) {
            $member->delete();
        }

        return redirect()->back();
    }
}
