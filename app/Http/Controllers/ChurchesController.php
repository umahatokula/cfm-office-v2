<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Church;
use App\Models\Pastor;
use App\Models\AccountType;

class ChurchesController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['churches-menu'] = 1;
        $data['members'] = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');

        return view('churches.create', $data);
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

        $rules=[
        'name'            => 'required', 
        'address'         => 'required',
        'resident_pastor' => 'required',
        ];

        // $this->validate($request, $rules);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        // save church info
        $church          = new Church;
        $church->name    = $request->name;
        $church->email   = $request->email;
        $church->phone   = $request->phone;
        $church->address = $request->address;
        $church->pastor  = $request->resident_pastor;
        $church->save();

        // save resident pastor
        $residentPastor              = new Pastor;
        $residentPastor->church_id   = $church->id;
        $residentPastor->member_id   = $request->resident_pastor;
        $residentPastor->is_resident = 1;
        $residentPastor->save();

        // change member's church
        $member            = Member::find($request->resident_pastor);
        $member->church_id = $church->id;
        $member->save();
        
        // save associate pastor
        for ($i=0; $i < count($request->associate_pastors); $i++) { 
            $associatePastors              = new Pastor;
            $associatePastors->church_id   = $church->id;
            $associatePastors->member_id   = $request->associate_pastors[$i];
            $associatePastors->is_resident = 0;
            $associatePastors->save();


            $resirent_member            = Member::find($request->associate_pastors[$i]);
            $resirent_member->church_id = $church->id;
            $resirent_member->save();
        }

        // create account type entries for this church
        $tithes                   = new AccountType;
        $tithes->church_id        = $church->id;
        $tithes->account_type     = 'Tithes';
        $tithes->percentage       = 10;
        $tithes->save();
        
        $welfare                  = new AccountType;
        $welfare->church_id       = $church->id;
        $welfare->account_type    = 'Welfare';
        $welfare->percentage      = 25;
        $welfare->save();
        
        $savings                  = new AccountType;
        $savings->church_id       = $church->id;
        $savings->account_type    = 'Savings';
        $savings->percentage      = 25;
        $savings->save();
        
        $operations               = new AccountType;
        $operations->church_id    = $church->id;
        $operations->account_type = 'Operations';
        $operations->percentage   = 40;
        $operations->save();

        session()->flash('successMessage', 'Church created successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Church created successfully' ]);
        }

        return redirect('settings');
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
        $data['churches-menu'] = 1;
        $data['members'] = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
        $data['church'] = Church::find($id);
        $data['residentPastor'] = Pastor::where(['church_id' => $id, 'is_resident' => 1])->first();
        $associatePastors = Pastor::select('member_id')->where(['church_id' => $id, 'is_resident' => 0])->get()->toArray();
        $data['associatePastors'] = array_flatten($associatePastors);

        return view('churches.edit', $data);
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

        $rules=[
        'name'            => 'required',
        'address'         => 'required',
        'resident_pastor' => 'required',
        ];

        // $this->validate($request, $rules);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        // save church info
        $church          = Church::find($id);
        $church->name    = $request->name;
        $church->email   = $request->email;
        $church->phone   = $request->phone;
        $church->address = $request->address;
        $church->pastor  = $request->resident_pastor;
        $church->save();

        // save resident pastor
        $residentPastor              = Pastor::where('church_id', $church->id)->first();
        $residentPastor->church_id   = $church->id;
        $residentPastor->member_id   = $request->resident_pastor;
        $residentPastor->is_resident = 1;
        $residentPastor->save();

        // change member's church
        $member            = Member::find($request->resident_pastor);
        $member->church_id = $church->id;
        $member->save();

        // delete all associate associate_pastors
        \DB::table('pastors')->where(['church_id' => $church->id, 'is_resident' => 0])->delete();
        
        // save associate pastor
        for ($i=0; $i < count($request->associate_pastors); $i++) { 
            $associatePastors              = new Pastor;
            $associatePastors->church_id   = $church->id;
            $associatePastors->member_id   = $request->associate_pastors[$i];
            $associatePastors->is_resident = 0;
            $associatePastors->save();


            $resirent_member            = Member::find($request->associate_pastors[$i]);
            $resirent_member->church_id = $church->id;
            $resirent_member->save();
        }

        session()->flash('successMessage', 'Church created successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Church created successfully' ]);
        }

        return redirect('settings');
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
}
