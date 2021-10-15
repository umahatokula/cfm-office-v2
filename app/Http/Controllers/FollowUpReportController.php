<?php

namespace App\Http\Controllers;

use App\Models\FollowUpReport;
use Illuminate\Http\Request;

class FollowUpReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $followUpReports = FollowUpReport::all()->paginate(5);

        return view('frontend.pages.dashboard.views.index', ['followUpReport' => $followUpReports]);
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
        // $userId = Auth::user()->id;
        $input = $request->input();
        // $input['user_id'] = $userId;
        $followUpReport = FollowUpReport::create($input);

        //check if followUpReport was created successfully or not and send a notification
        if ($followUpReport) {
            $request->session()->flash('success', 'FollowUpReport successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, FollowUpReport not saved');
        }

        return redirect('todo');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUpReport  $followUpReport
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpReport $followUpReport)
    {
        //
        //Get authenticated user and display a single FollowUpReport

        $followUpReport = FollowUpReport::where(['id' => $followUpReport->id])->first();
        if (!$followUpReport) {
            return redirect('todo')->with('error', 'FollowUpReport not found');
        }
        return view('todo.view', ['todo' => $followUpReport]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUpReport  $followUpReport
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUpReport $followUpReport)
    {
        //
        ////Get authenticated user and display FollowUpReport to edit

        $followUpReport = FollowUpReport::where(['id' => $followUpReport->id])->first();
        if ($followUpReport) {
            return view('todo.edit', [ 'todo' => $followUpReport ]);
        } else {
            return redirect('todo')->with('error', 'FollowUpReport not found');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUpReport  $followUpReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpReport $followUpReport)
    {
        //
        //Get authenticated user and update FollowUpReport
        $followUpReport = FollowUpReport::find($followUpReport->id);
        if (!$followUpReport) {
            return redirect('todo')->with('error', 'FollowUpReport not found.');
        }
        $input = $request->input();

        $followUpReport = $followUpReport->update($input);
        if ($followUpReport) {
            return redirect('todo')->with('success', 'FollowUpReport successfully updated.');
        } else {
            return redirect('todo')->with('error', 'Oops something went wrong. FollowUpReport not updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUpReport  $followUpReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpReport $followUpReport)
    {
        //
        //Get authenticated user and delete a specific FollowUpReport

        $followUpReport = FollowUpReport::where(['id' => $followUpReport->id])->first();
        $respStatus = $respMsg = '';
        if (!$followUpReport) {
            $respStatus = 'error';
            $respMsg = 'FollowUpReport not found';
        }
        $followUpReportDelStatus = $followUpReport->delete();
        if ($followUpReportDelStatus) {
            $respStatus = 'success';
            $respMsg = 'FollowUpReport deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. FollowUpReport not deleted successfully';
        }
        return redirect('todo')->with($respStatus, $respMsg);

    }
}
