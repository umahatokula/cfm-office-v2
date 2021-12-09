<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\GrowthPath;
use App\Models\MemberGrowthPath;

class GrowthPathController extends Controller
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
     * show a particular resource
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
    	$data['member'] =  Member::find($id);
    	$data['growthPaths'] =  GrowthPath::all();
    	$data['myGrowthPaths'] =  MemberGrowthPath::where('member_id', $id)->pluck('growth_path_id')->toArray();

    	return view('growth-paths.show', $data);
    }

    /**
     * Add a member to a ministry
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMembersToGrowthPath(Request $request)
    {
        // dd($request->all());

        // save if chekced
        if ($request->checked == 'true') {
            $memberGrowthPath = MemberGrowthPath::where(['member_id' => $request->member_id, 'growth_path_id' => $request->growth_path_id, 'church_id' => \Auth::user()->member->church_id])->first();

            // save if it doesnt already exist
            if (!$memberGrowthPath) {

                $memberGrowthPath = new MemberGrowthPath;
                $memberGrowthPath->member_id = $request->member_id;
                $memberGrowthPath->growth_path_id = $request->growth_path_id;
                $memberGrowthPath->church_id = \Auth::user()->member_id;
                $memberGrowthPath->save();           
            }

            return ['success' => true, 'message' => 'Added'];
        }

        // delete if unchecked
        if ($request->checked == 'false') {
            $memberGrowthPath = MemberGrowthPath::where(['member_id' => $request->member_id, 'growth_path_id' => $request->growth_path_id, 'church_id' => \Auth::user()->member->church_id])->first();

            if ($memberGrowthPath) {
                // $delete = $memberGrowthPath->delete();
                $delete = \DB::table('member_growth_paths')->where(['member_id' => $request->member_id, 'growth_path_id' => $request->growth_path_id, 'church_id' => \Auth::user()->member->church_id])->delete();
            }

            return ['success' => true, 'message' => 'Deleted'];
        }
    }
}
