<?php

namespace App\Http\Controllers;

use App\Models\FollowupTarget;
use App\Models\LifeCoach;
use App\Models\LifeCoachTarget;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LifeCoachTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //begin here
        // $member = FollowupTarget::find(2);
        // $lifeCoach = [10, 7];
        // // $member->lifecoaches()->attach($lifeCoach);

        // $folks = $member->lifecoaches;
        // // dd($folks[1]->fname);

        $coach = LifeCoach::find(1);
        // $target = [10, 7];
        // $coach->followuptargets()->attach($target);

        $folks = $coach->followuptargets;
        // dd($folks);


        // //Get authenticated user id
        // // $userId = Auth::user()->id;

        // $members = FollowupTarget::where(['user_id' => $userId])->paginate(5);
        $coaches = LifeCoach::limit(5)->get();

        return view('frontend.pages.life-coach.coach-targets', ['coaches'=>$coaches, 'folks'=>$folks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $followUpTargets = FollowupTarget::all();
        $lifeCoaches = LifeCoach::all();
        return view('frontend.pages.follow-up-targets.assign-target', ['followUpTargets'=>$followUpTargets, 'lifeCoaches'=>$lifeCoaches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $target = FollowupTarget::find($request->input('targets'))->first();
        $coach = LifeCoach::find($request->input('coaches'))->first();
        $coach->followUpTargets()->attach($target);
        return view('frontend.pages.follow-up-targets.assign-target')->with('success', 'Assigned successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function show(LifeCoach $lifeCoach)
    {
        //
        //Get authenticated user and display a single todo
/*         $userId = Auth::user()->id;
        $todo = Todo::where(['user_id' => $userId, 'id' => $todo->id])->first();
        if (!$todo) {
            return redirect('todo')->with('error', 'Todo not found');
        }
        return view('todo.view', ['todo' => $todo]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function edit(LifeCoach $lifeCoach)
    {
        //
        ////Get authenticated user and display todo to edit
/*         $userId = Auth::user()->id;
        $todo = Todo::where(['user_id' => $userId, 'id' => $todo->id])->first();
        if ($todo) {
            return view('todo.edit', [ 'todo' => $todo ]);
        } else {
            return redirect('todo')->with('error', 'Todo not found');
        } */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LifeCoach $lifeCoach)
    {
        //
        //Get authenticated user and update todo
        // $userId = Auth::user()->id;
        // $todo = Todo::find($todo->id);
        // if (!$todo) {
        //     return redirect('todo')->with('error', 'Todo not found.');
        // }
        // $input = $request->input();
        // $input['user_id'] = $userId;
        // $todoStatus = $todo->update($input);
        // if ($todoStatus) {
        //     return redirect('todo')->with('success', 'Todo successfully updated.');
        // } else {
        //     return redirect('todo')->with('error', 'Oops something went wrong. Todo not updated');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function destroy(LifeCoach $lifeCoach)
    {
        //
        //Get authenticated user and delete a specific todo
        /* $userId = Auth::user()->id;
        $todo = Todo::where(['user_id' => $userId, 'id' => $todo->id])->first();
        $respStatus = $respMsg = '';
        if (!$todo) {
            $respStatus = 'error';
            $respMsg = 'Todo not found';
        }
        $todoDelStatus = $todo->delete();
        if ($todoDelStatus) {
            $respStatus = 'success';
            $respMsg = 'Todo deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Todo not deleted successfully';
        }
        return redirect('todo')->with($respStatus, $respMsg); */
    }
}
