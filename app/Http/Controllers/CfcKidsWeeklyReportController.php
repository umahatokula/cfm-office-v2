<?php

namespace App\Http\Controllers;

use App\Models\CfcKidsWeeklyReport;
use App\Models\Church;
use Illuminate\Http\Request;

class CfcKidsWeeklyReportController extends Controller
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
        // $reports = CfcKidsWeeklyReport::where('church_id', \Auth::user()->member->church_id)->get();
        $reports = CfcKidsWeeklyReport::all();
        $data['reports'] = $reports;

        return view('cfc-kids-weekly-report.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['churches'] = Church::pluck('name', 'id');
        return view('cfc-kids-weekly-report.create', $data);
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
            'date'                 => 'required',
            'lesson_taught'              => 'required',
            'attendance_boys'         => 'required',
            'attendance_girls'          => 'required',
            'saved'            => 'required',
            'holy_ghost'            => 'required',
            'offerings'     => 'required',
            'tithe' => 'required',
            'teachers' => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $report = new CfcKidsWeeklyReport;
        $report->church_id           = $request->church_id;  
        $report->date    = $request->date;   
        $report->lesson_taught        = $request->lesson_taught; 
        $report->memory_verse    = $request->memory_verse;
        $report->attendance_boys    = $request->attendance_boys;
        $report->attendance_girls    = $request->attendance_girls;
        $report->saved = $request->saved;
        $report->holy_ghost = $request->holy_ghost;
        $report->offerings      = $request->offerings;
        $report->tithe      = $request->tithe;
        $report->teachers      = $request->teachers;
        $report->save();

        return redirect('cfc-kids-weekly-report');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CfcKidsWeeklyReport  $cfcKidsWeeklyReport
     * @return \Illuminate\Http\Response
     */
    public function show(CfcKidsWeeklyReport $cfcKidsWeeklyReport)
    {
        $data['report'] = CfcKidsWeeklyReport::find($cfcKidsWeeklyReport->id);
        return view('cfc-kids-weekly-report.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CfcKidsWeeklyReport  $cfcKidsWeeklyReport
     * @return \Illuminate\Http\Response
     */
    public function edit(CfcKidsWeeklyReport $cfcKidsWeeklyReport)
    {
        $data['report'] = CfcKidsWeeklyReport::find($cfcKidsWeeklyReport->id);
        $data['churches'] = Church::pluck('name', 'id');
        return view('cfc-kids-weekly-report.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CfcKidsWeeklyReport  $cfcKidsWeeklyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CfcKidsWeeklyReport $cfcKidsWeeklyReport)
    {
        // dd($request->all());

        $rules = [
            'date'                 => 'required',
            'lesson_taught'              => 'required',
            'attendance_boys'         => 'required',
            'attendance_girls'          => 'required',
            'saved'            => 'required',
            'holy_ghost'            => 'required',
            'offerings'     => 'required',
            'tithe' => 'required',
            'teachers' => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $report = CfcKidsWeeklyReport::find($cfcKidsWeeklyReport->id);
        $report->church_id           = $request->church_id;  
        $report->date    = $request->date;   
        $report->lesson_taught        = $request->lesson_taught; 
        $report->memory_verse    = $request->memory_verse;
        $report->attendance_boys    = $request->attendance_boys;
        $report->attendance_girls    = $request->attendance_girls;
        $report->saved = $request->saved;
        $report->holy_ghost = $request->holy_ghost;
        $report->offerings      = $request->offerings;
        $report->tithe      = $request->tithe;
        $report->teachers      = $request->teachers;
        $report->save();

        return redirect('cfc-kids-weekly-report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CfcKidsWeeklyReport  $cfcKidsWeeklyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CfcKidsWeeklyReport $cfcKidsWeeklyReport)
    {
        //
    }

    public function delete($id) {
        $report = CfcKidsWeeklyReport::find($id);
        $report->delete();

        return redirect('cfc-kids-weekly-report');
    }
}
