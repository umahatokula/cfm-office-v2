<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowupReason;
use App\Models\FollowUp;
use App\Models\AgeProfile;

class FollowUpReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['reasonsMenu'] = 1;
        $data['reasons'] = FollowupReason::where('church_id', \Auth::user()->member->church_id)->get();
        $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->get();

        return view('reasons.index', $data);
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
        'reason' => 'required'
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('reason') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        //save if no id exist for the follow up reason
        if ($request->id == '') {
            $followUpReason = new FollowupReason;
            $followUpReason->reason     = $request->reason;
            $followUpReason->church_id  = \Auth::user()->member->church_id;
            $followUpReason->save();

            return response()->json(['success' => true, 'message' => 'Follow Up Reason added.', 'reason' => $followUpReason ]);
        } else {
            $followUpReason = FollowupReason::find($request->id);
            $followUpReason->reason     = $request->reason;
            $followUpReason->church_id  = \Auth::user()->member->church_id;
            $followUpReason->save();

            return response()->json(['success' => true, 'message' => 'Follow Up Reason updated.', 'reason' => $followUpReason ]);
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

        $followUpReason = FollowupReason::find($request->id);

        if ($followUpReason) {

            // check if this reason is in use by a follow up item
            $attached = FollowUp::where('reason_id', $request->id)->first();

            if ($attached) {
                return response()->json(['success' => false, 'message' => 'Follow Up Reason is in use therefore cannot be deleted.' ]);
            }

            $deleted = $followUpReason->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Follow Up Reason deleted.' ]);
            } else {
                return response()->json(['success' => false, 'message' => 'An error occured in deleting' ]);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Follow Up Reason doesn\'t exist in our records.' ]);
        }
    }
}
