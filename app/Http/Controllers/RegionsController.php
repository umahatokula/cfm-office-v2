<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionsController extends Controller
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
        $data['regionMenu'] = 1;
        $data['regions'] = Region::where('church_id', \Auth::user()->member->church_id)->get();

        return view('regions.index', $data);
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
        'region' => 'required'
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('region') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        //save if no id exist for the region
        if ($request->id == '') {
            $region = new Region;
            $region->region     = $request->region;
            $region->church_id  = \Auth::user()->member->church_id;
            $region->save();

            return response()->json(['success' => true, 'message' => 'Region added.', 'region' => $region ]);
        } else {
            $region = Region::find($request->id);
            $region->region     = $request->region;
            $region->church_id  = \Auth::user()->member->church_id;
            $region->save();

            return response()->json(['success' => true, 'message' => 'Region updated.', 'region' => $region ]);
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

        $region = Region::find($request->id);

        if ($region) {

            $deleted = $region->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Region deleted.' ]);
            } else {
                return response()->json(['success' => false, 'message' => 'An error occured in deleting' ]);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Region doesn\'t exist in our records.' ]);
        }
    }
}
