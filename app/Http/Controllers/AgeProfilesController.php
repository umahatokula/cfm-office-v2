<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\AgeProfile;

class AgeProfilesController extends Controller
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
        $data['ageProfileMenu'] = 1;
        $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->get();

        return view('age-profiles.index', $data);
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
        // dd($request->all());

        $rules = [
        'age_profile' => 'required',
        'lower_bound' => 'required',
        'upper_bound' => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('age_profile') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        //save if no id exist for the follow up reason
        if ($request->id == '') {
            $ageProfile = new AgeProfile;
            $ageProfile->age_profile     = $request->age_profile;
            $ageProfile->lower_bound     = $request->lower_bound;
            $ageProfile->upper_bound     = $request->upper_bound;
            $ageProfile->church_id       = \Auth::user()->member->church_id;
            $ageProfile->save();

            return response()->json(['success' => true, 'message' => 'Age profile added.', 'ageProfile' => $ageProfile ]);
        } else {
            $ageProfile = AgeProfile::find($request->id);
            $ageProfile->age_profile     = $request->age_profile;
            $ageProfile->lower_bound     = $request->lower_bound;
            $ageProfile->upper_bound     = $request->upper_bound;
            $ageProfile->church_id       = \Auth::user()->member->church_id;
            $ageProfile->save();

            return response()->json(['success' => true, 'message' => 'Age profile updated.', 'ageProfile' => $ageProfile ]);
        }


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
        //
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
        //
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
    public function delete(Request $request)
    {
        // dd($request->all());

        $followUpReason = AgeProfile::find($request->id);

        if ($followUpReason) {

            // check if this reason is in use by a follow up item
            $attached = FollowUp::where('age_profile_id', $request->id)->first();

            if ($attached) {
                return response()->json(['success' => false, 'message' => 'Age profile is in use therefore cannot be deleted.' ]);
            }

            $deleted = $followUpReason->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Age profile deleted.' ]);
            } else {
                return response()->json(['success' => false, 'message' => 'An error occured in deleting' ]);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Age profile doesn\'t exist in our records.' ]);
        }
    }
}
