<?php

namespace App\Http\Controllers;

use App\WeeklyChurchReport;
use Illuminate\Http\Request;

use App\Models\Church;
use App\Models\ChurchTask;
use App\Models\ChurchActivity;
use App\Models\ChurchProgramEvaluation;
use App\Models\ChurchSundayTestimony;

class WeeklyChurchReportController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {

        if ($id) {
            $data['weeklyReportMenu'] = 1;

            if (\Auth::user()->hasRole('generaloverseer') || \Auth::user()->hasRole('coordinatorchurches')) {
                $data['reports'] = WeeklyChurchReport::orderBy('created_at', 'desc')->get();
            }

            if (\Auth::user()->hasRole('residentpastor')) {
                $data['reports'] = WeeklyChurchReport::where('member_id', \Auth::user()->member->id)->orderBy('created_at', 'desc')->get();
            }
            
            $report = WeeklyChurchReport::with('filedBy', 'checkedBy')->orderBy('created_at', 'desc')->where('id', $id)->first();
            $data['reportDetail'] = $report;

            return view('weekly-reports.index', $data);
        }

        $data['weeklyReportMenu'] = 1;

        if (\Auth::user()->hasRole('generaloverseer') || \Auth::user()->hasRole('coordinatorchurches')) {
            $q = WeeklyChurchReport::query();
            if (request('checked') == 1) {
                $q->where('checked_by', '!=', null);
            }
            if (request('checked') == 0) {
                $q->where('checked_by', '=', null);
            }
            $data['reports'] = $q->orderBy('created_at', 'desc')->get();
        }

        if (\Auth::user()->hasRole('residentpastor')) {
            $q = WeeklyChurchReport::query();
            if (request('checked') == 1) {
                $q->where('checked_by', '!=', null);
            }
            if (request('checked') == 0) {
                $q->where('checked_by', '=', null);
            }
            $data['reports'] = $q->where('member_id', \Auth::user()->member->id)->orderBy('created_at', 'desc')->get();
        }

        return view('weekly-reports.index', $data);
        // dd($report);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['weeklyReportMenu'] = 1;
        $data['churches'] = Church::pluck('name', 'id');

        return view('weekly-reports.create', $data);
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
        'from'            => 'required', 
        'to'              => 'required', 
        'subject'         => 'required',
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
        $weeklyReport                           = new WeeklyChurchReport;
        $weeklyReport->church_id                = \Auth::user()->member->church_id;
        $weeklyReport->member_id                = \Auth::user()->member->id;
        $weeklyReport->from                     = $request->from;
        $weeklyReport->to                       = $request->to;
        $weeklyReport->subject                  = $request->subject;
        $weeklyReport->tasks_completed          = $request->tasks_completed;
        $weeklyReport->sunday_attendance        = $request->sunday_attendance;
        $weeklyReport->sunday_salvation         = $request->sunday_salvation;
        $weeklyReport->sunday_holy_ghost        = $request->sunday_holy_ghost;
        $weeklyReport->sunday_first_time_guests = $request->sunday_first_time_guests;
        $weeklyReport->sunday_children_church   = $request->sunday_children_church;
        $weeklyReport->sunday_offering          = $request->sunday_offering;
        $weeklyReport->sunday_tithes            = $request->sunday_tithes;
        $weeklyReport->sunday_church_tithes     = $request->sunday_church_tithes;
        $weeklyReport->sunday_depositor         = $request->sunday_depositor;
        $weeklyReport->wed_attendance           = $request->wed_attendance;
        $weeklyReport->wed_salvation            = $request->wed_salvation;
        $weeklyReport->wed_holy_ghost           = $request->wed_holy_ghost;
        $weeklyReport->wed_first_time_guests    = $request->wed_first_time_guests;
        $weeklyReport->wed_children_church      = $request->wed_children_church;
        $weeklyReport->wed_offering             = $request->wed_offering;
        $weeklyReport->wed_tithes               = $request->wed_tithes;
        $weeklyReport->wed_church_tithes        = $request->wed_church_tithes;
        $weeklyReport->wed_depositor            = $request->wed_depositor;
        $weeklyReport->others_attendance        = $request->others_attendance;
        $weeklyReport->others_salvation         = $request->others_salvation;
        $weeklyReport->others_holy_ghost        = $request->others_holy_ghost;
        $weeklyReport->others_first_time_guests = $request->others_first_time_guests;
        $weeklyReport->others_children_church   = $request->others_children_church;
        $weeklyReport->others_offering          = $request->others_offering;
        $weeklyReport->others_tithes            = $request->others_tithes;
        $weeklyReport->others_church_tithes     = $request->others_church_tithes;
        $weeklyReport->others_depositor         = $request->others_depositor;
        $weeklyReport->issues                   = $request->issues;
        $weeklyReport->filed_by                 = \Auth::user()->member_id;
        $weeklyReport->comments                 = $request->comments;
        $weeklyReport->remarks                  = $request->remarks;
        $weeklyReport->save();

        
        // save tasks
        for ($i=0; $i < count($request->task); $i++) { 
            try{
                $task                          = new ChurchTask;
                $task->weekly_church_report_id = $weeklyReport->id;
                $task->task                    = $request->task[$i];
                $task->action                  = $request->action[$i];
                $task->due_date                = $request->due_date[$i];
                $task->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete WeeklyChurchReport
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured. Enter some tasks.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured. Enter some tasks.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save activities
        for ($i=0; $i < count($request->activity); $i++) { 
            try{
                $activity                          = new ChurchActivity;
                $activity->weekly_church_report_id = $weeklyReport->id;
                $activity->activity                = $request->activity[$i];
                $activity->save();

            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save prgram evaluations
        for ($i=0; $i < count($request->program); $i++) { 
            try{
                $program                          = new ChurchProgramEvaluation;
                $program->weekly_church_report_id = $weeklyReport->id;
                $program->program                 = $request->program[$i];
                $program->evaluation              = $request->evaluation[$i];
                $program->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchActivity::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save sundaytestimonies
        for ($i=0; $i < count($request->details); $i++) { 
            try{
                $testimony                          = new ChurchSundayTestimony;
                $testimony->weekly_church_report_id = $weeklyReport->id;
                $testimony->name                    = $request->name[$i];
                $testimony->details                 = $request->details[$i];
                $testimony->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchActivity::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchProgramEvaluation::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }


        session()->flash('successMessage', 'Reported submitted successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Reported submitted successfully' ]);
        }

        return redirect('weekly-church-report');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeeklyChurchReport  $weeklyChurchReport
     * @return \Illuminate\Http\Response
     */
    public function show(WeeklyChurchReport $weeklyChurchReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeeklyChurchReport  $weeklyChurchReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['weeklyReportMenu'] = 1;
        $data['churches'] = Church::pluck('name', 'id');

        $data['reportDetail'] = WeeklyChurchReport::with('filedBy', 'checkedBy')->where('id', $id)->first();

        return view('weekly-reports.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeeklyChurchReport  $weeklyChurchReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);

        $rules=[
        'from'            => 'required', 
        'to'              => 'required', 
        'subject'         => 'required',
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
        $weeklyReport                           = WeeklyChurchReport::find($id);
        $weeklyReport->church_id                = \Auth::user()->member->church_id;
        $weeklyReport->member_id                = \Auth::user()->member->id;
        $weeklyReport->from                     = $request->from;
        $weeklyReport->to                       = $request->to;
        $weeklyReport->subject                  = $request->subject;
        $weeklyReport->tasks_completed          = $request->tasks_completed;
        $weeklyReport->sunday_attendance        = $request->sunday_attendance;
        $weeklyReport->sunday_salvation         = $request->sunday_salvation;
        $weeklyReport->sunday_holy_ghost        = $request->sunday_holy_ghost;
        $weeklyReport->sunday_first_time_guests = $request->sunday_first_time_guests;
        $weeklyReport->sunday_children_church   = $request->sunday_children_church;
        $weeklyReport->sunday_offering          = $request->sunday_offering;
        $weeklyReport->sunday_tithes            = $request->sunday_tithes;
        $weeklyReport->sunday_church_tithes     = $request->sunday_church_tithes;
        $weeklyReport->sunday_depositor         = $request->sunday_depositor;
        $weeklyReport->wed_attendance           = $request->wed_attendance;
        $weeklyReport->wed_salvation            = $request->wed_salvation;
        $weeklyReport->wed_holy_ghost           = $request->wed_holy_ghost;
        $weeklyReport->wed_first_time_guests    = $request->wed_first_time_guests;
        $weeklyReport->wed_children_church      = $request->wed_children_church;
        $weeklyReport->wed_offering             = $request->wed_offering;
        $weeklyReport->wed_tithes               = $request->wed_tithes;
        $weeklyReport->wed_church_tithes        = $request->wed_church_tithes;
        $weeklyReport->wed_depositor            = $request->wed_depositor;
        $weeklyReport->others_attendance        = $request->others_attendance;
        $weeklyReport->others_salvation         = $request->others_salvation;
        $weeklyReport->others_holy_ghost        = $request->others_holy_ghost;
        $weeklyReport->others_first_time_guests = $request->others_first_time_guests;
        $weeklyReport->others_children_church   = $request->others_children_church;
        $weeklyReport->others_offering          = $request->others_offering;
        $weeklyReport->others_tithes            = $request->others_tithes;
        $weeklyReport->others_church_tithes     = $request->others_church_tithes;
        $weeklyReport->others_depositor         = $request->others_depositor;
        $weeklyReport->issues                   = $request->issues;
        $weeklyReport->filed_by                 = \Auth::user()->member_id;
        $weeklyReport->comments                 = $request->comments;
        $weeklyReport->remarks                  = $request->remarks;
        $weeklyReport->save();

        
        // save tasks
        ChurchTask::where('weekly_church_report_id', $id)->delete();
        for ($i=0; $i < count($request->task); $i++) { 
            try{
                $task                          = new ChurchTask;
                $task->weekly_church_report_id = $weeklyReport->id;
                $task->task                    = $request->task[$i];
                $task->action                  = $request->action[$i];
                $task->due_date                = $request->due_date[$i];
                $task->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete WeeklyChurchReport
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured. Enter some tasks.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured. Enter some tasks.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save activities
        ChurchActivity::where('weekly_church_report_id', $id)->delete();
        for ($i=0; $i < count($request->activity); $i++) { 
            try{
                $activity                          = new ChurchActivity;
                $activity->weekly_church_report_id = $weeklyReport->id;
                $activity->activity                = $request->activity[$i];
                $activity->save();

            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save prgram evaluations
        ChurchProgramEvaluation::where('weekly_church_report_id', $id)->delete();
        for ($i=0; $i < count($request->program); $i++) { 
            try{
                $program                          = new ChurchProgramEvaluation;
                $program->weekly_church_report_id = $weeklyReport->id;
                $program->program                 = $request->program[$i];
                $program->evaluation              = $request->evaluation[$i];
                $program->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchActivity::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }
        
        // save sundaytestimonies
        ChurchSundayTestimony::where('weekly_church_report_id', $id)->delete();
        for ($i=0; $i < count($request->details); $i++) { 
            try{
                $testimony                          = new ChurchSundayTestimony;
                $testimony->weekly_church_report_id = $weeklyReport->id;
                $testimony->name                    = $request->name[$i];
                $testimony->details                 = $request->details[$i];
                $testimony->save();
            } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[0];
                if($errorCode == 23502){

                    // delete
                    WeeklyChurchReport::where('id', $weeklyReport->id)->delete();
                    ChurchTask::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchActivity::where('weekly_church_report_id', $weeklyReport->id)->delete();
                    ChurchProgramEvaluation::where('weekly_church_report_id', $weeklyReport->id)->delete();

                    if ($request->ajax()) {
                        return response()->json(['success' => FALSE, 'message' => 'An error occured.' ]);
                    }

                    session()->flash('errorMessage', 'An error occured.');
                    return redirect()->back()->withInput();
                }
            }
        }


        session()->flash('successMessage', 'Changes saved successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Reported submitted successfully' ]);
        }

        return redirect('weekly-church-report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeeklyChurchReport  $weeklyChurchReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeeklyChurchReport $weeklyChurchReport)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeeklyChurchReport  $weeklyChurchReport
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        return WeeklyChurchReport::find($id);
    }

    public function review(Request $request, $id) {
        // dd($request->all(), $id);

        $report = WeeklyChurchReport::find($id);
        $report->comments = $request->comment;
        $report->checked_by = \Auth::user()->member_id;
        $report->save();

        session()->flash('successMessage', 'Comment saved');

        return redirect()->back();
    }
}
