<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberChurchRole;
use App\Models\ChurchRole;

class ChurchRolesController extends Controller
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
        $data['churchRoleMenu'] = 1;
        $data['churchRoles'] = ChurchRole::where('church_id', \Auth::user()->member->church_id)->get();

        return view('church-roles.index', $data);
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
        'name' => 'required'
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        //save if no id exist for the church role
        if ($request->id == '') {
            $churchRole = new ChurchRole;
            $churchRole->name     = $request->name;
            $churchRole->church_id  = \Auth::user()->member->church_id;
            $churchRole->save();

            return response()->json(['success' => true, 'message' => 'Church Role added.', 'churchRole' => $churchRole ]);
        } else {
            $churchRole = ChurchRole::find($request->id);
            $churchRole->name     = $request->name;
            $churchRole->church_id  = \Auth::user()->member->church_id;
            $churchRole->save();

            return response()->json(['success' => true, 'message' => 'Church Role updated.', 'churchRole' => $churchRole ]);
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

        $churchRole = ChurchRole::find($request->id);

        if ($churchRole) {

            $deleted = $churchRole->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Church Role deleted.' ]);
            } else {
                return response()->json(['success' => false, 'message' => 'An error occured in deleting' ]);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Church Role doesn\'t exist in our records.' ]);
        }
    }

    /**
     * Add a member to a church role
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMembersToChurchRole(Request $request)
    {
        // dd($request->all());

        // save if chekced
        if ($request->checked == 'true') {
            $memberMinistry = MemberChurchRole::where(['member_id' => $request->member_id, 'church_role_id' => $request->church_role_id, 'church_id' => \Auth::user()->member->church_id])->first();

            // save if it doesnt already exist
            if (!$memberMinistry) {

                $memberMinistry = new MemberChurchRole;
                $memberMinistry->member_id = $request->member_id;
                $memberMinistry->church_role_id = $request->church_role_id;
                $memberMinistry->church_id = \Auth::user()->member_id;
                $memberMinistry->save();           
            }

            return ['success' => true, 'message' => 'Added'];
        }

        // delete if unchecked
        if ($request->checked == 'false') {
            $memberMinistry = MemberChurchRole::where(['member_id' => $request->member_id, 'church_role_id' => $request->church_role_id, 'church_id' => \Auth::user()->member->church_id])->first();

            if ($memberMinistry) {
                // $delete = $memberMinistry->delete();
                $delete = \DB::table('member_church_roles')->where(['member_id' => $request->member_id, 'church_role_id' => $request->church_role_id, 'church_id' => \Auth::user()->member->church_id])->delete();
            }

            return ['success' => true, 'message' => 'Deleted'];
        }
    }
}
