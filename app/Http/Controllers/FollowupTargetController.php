<?php

namespace App\Http\Controllers;

use App\Models\FollowupTarget;
use Illuminate\Http\Request;

class FollowupTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $member = FollowupTarget::find(2);
        $followupTarget = [1, 2];
        $member->lifecoaches()->attach($followupTarget);

        dd($member->lifecoaches);
        */

        //Get authenticated user id
        // $userId = Auth::user()->id;

        $followupTarget = FollowupTarget::all()->paginate(5);

        return view('frontend.pages.dashboard.views.index', ['followupTarget' => $followupTarget]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todo.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        // $userId = Auth::user()->id;
        $input = $request->input();
        // $input['user_id'] = $userId;
        $followupTarget = FollowupTarget::create($input);

        //check if follow_up_target was created successfully or not and send a notification
        if ($followupTarget) {
            $request->session()->flash('success', 'FollowupTarget successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, FollowupTarget not saved');
        }

        return redirect()->route('create-target');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function show(FollowupTarget $followupTarget)
    {
        //
        //Get authenticated user and display a single follow_up_target

        $follow_up_target = FollowupTarget::where(['id' => $followupTarget->id])->first();
        if (!$follow_up_target) {
            return redirect('todo')->with('error', 'FollowupTarget not found');
        }
        return view('todo.view', ['follow_up_target' => $follow_up_target]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowupTarget $followupTarget)
    {
        //
        ////Get authenticated user and display follow_up_target to edit

        $follow_up_target = FollowupTarget::where(['id' => $followupTarget->id])->first();
        if ($follow_up_target) {
            return view('todo.edit', [ 'todo' => $follow_up_target ]);
        } else {
            return redirect('todo')->with('error', 'FollowupTarget not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowupTarget $followupTarget)
    {
        //
        //Get authenticated user and update follow_up_target

        $follow_up_target = FollowupTarget::find($followupTarget->id);
        if (!$follow_up_target) {
            return redirect('todo')->with('error', 'FollowupTarget not found.');
        }
        $input = $request->input();
        $todoStatus = $follow_up_target->update($input);
        if ($todoStatus) {
            return redirect('todo')->with('success', 'FollowupTarget successfully updated.');
        } else {
            return redirect('todo')->with('error', 'Oops something went wrong. FollowupTarget not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowupTarget $followupTarget)
    {
        //
        //Get authenticated user and delete a specific follow_up_target
        $follow_up_target = FollowupTarget::where(['id' => $followupTarget->id])->first();
        $respStatus = $respMsg = '';
        if (!$follow_up_target) {
            $respStatus = 'error';
            $respMsg = 'FollowupTarget not found';
        }
        $todoDelStatus = $follow_up_target->delete();
        if ($todoDelStatus) {
            $respStatus = 'success';
            $respMsg = 'FollowupTarget deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. FollowupTarget not deleted successfully';
        }
        return redirect('todo')->with($respStatus, $respMsg);
    }
}
