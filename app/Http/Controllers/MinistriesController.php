<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberMinistry;

class MinistriesController extends Controller
{
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
        //
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
     * Add a member to a ministry
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMembersToMinistry(Request $request)
    {
        // dd($request->all());

        // save if chekced
        if ($request->checked == 'true') {
            $memberMinistry = MemberMinistry::where(['member_id' => $request->member_id, 'ministry_id' => $request->ministry_id, 'church_id' => \Auth::user()->member->church_id])->first();

            // save if it doesnt already exist
            if (!$memberMinistry) {

                $memberMinistry = new MemberMinistry;
                $memberMinistry->member_id = $request->member_id;
                $memberMinistry->ministry_id = $request->ministry_id;
                $memberMinistry->church_id = \Auth::user()->member_id;
                $memberMinistry->save();           
            }

            return ['success' => true, 'message' => 'Added'];
        }

        // delete if unchecked
        if ($request->checked == 'false') {
            $memberMinistry = MemberMinistry::where(['member_id' => $request->member_id, 'ministry_id' => $request->ministry_id, 'church_id' => \Auth::user()->member->church_id])->first();

            if ($memberMinistry) {
                // $delete = $memberMinistry->delete();
                $delete = \DB::table('member_ministries')->where(['member_id' => $request->member_id, 'ministry_id' => $request->ministry_id, 'church_id' => \Auth::user()->member->church_id])->delete();
            }

            return ['success' => true, 'message' => 'Deleted'];
        }
    }
}
