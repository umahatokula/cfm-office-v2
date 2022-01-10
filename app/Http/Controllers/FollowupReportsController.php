<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\FollowUpReport;
use App\Models\FollowupTarget;

class FollowupReportsController extends Controller
{
    public $folk;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FollowupTarget $target)
    {
        return view('pages.follow-up.reports.create-report', [
            'target' => $target,
            'reports' => $target->reports,
            'lifeCoach' => $target->lifeCoaches[0],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FollowupTarget $target)
    {
        return view('pages.follow-up.reports.create-report', [
            'target' => $target,
            'lifeCoach' => $target->lifeCoaches[0],
        ]);

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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpReport $report)
    {
        return view('pages.follow-up.reports.view-report', ['report'=>$report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit($report)
    {
        $report = Report::where('id',$report)->first();

        return view('pages.follow-up.reports.edit-report', ['report'=>$report]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $report)
    {
        $report = Report::find($report);
        $report->report = $request->report;
        // $report->follow_up_target_id = $folk;
        // $report->life_coach_id = 2; #The coach id will be gotten from authenticated user id
        $report->save();
        redirect()->route('all-reports', ['folk'=>$report->follow_up_target_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
