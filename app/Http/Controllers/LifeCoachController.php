<?php

namespace App\Http\Controllers;

use App\Models\FollowupTarget;
use App\Models\LifeCoach;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LifeCoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //begin here
        $user = User::find(1);
        // $lifeCoach = [1, 2];
        // $member->lifecoaches()->attach($lifeCoach);

        // dd('life id: '.$member->life_coach_id);

        //Get authenticated user id
        $life_coach_id = $user->life_coach_id;

        $lifeCoach = LifeCoach::where(['id' => $life_coach_id])->first();

        $followupTargets = $lifeCoach->followUpTargets;

        return view('frontend.pages.life-coach.index', ['lifeCoaches' => $lifeCoach, 'followupTargets' => $followupTargets]);
    }

    public function list()
    {

        $coaches = LifeCoach::paginate(5);

        return view('frontend.pages.life-coach.all-life-coach' , ['coaches' => $coaches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frontend.pages.life-coach.create-life-coach');
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
        $lifeCoach = LifeCoach::create($input);

        //check if lifeCoach was created successfully or not and send a notification
        if ($lifeCoach) {
            $request->session()->flash('success', 'Life Coach successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, lifeCoach not saved');
        }

        return redirect()->route('create-life-coach');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function show($lifeCoach)
    {
        //
        //Get authenticated user and display a single lifeCoach
        $lifeCoach = LifeCoach::where(['id' => $lifeCoach])->first();
        if (!$lifeCoach) {
            return redirect()->route('create-life-coach')->with('error', 'lifeCoach not found. Create missing coach');
        }
        return view('frontend.pages.life-coach.show-life-coach', ['lifeCoach' => $lifeCoach]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function edit($lifeCoach)
    {
        //
        ////Get authenticated user and display lifeCoach to edit
        // $userId = Auth::user()->id;
        $lifeCoach = LifeCoach::where(['id' => $lifeCoach])->first();
        if ($lifeCoach) {
            return view('frontend.pages.life-coach.edit-life-coach', [ 'lifeCoach' => $lifeCoach ]);
        } else {
            return redirect('/')->with('error', 'lifeCoach not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lifeCoach)
    {

        $lifeCoach = LifeCoach::find($lifeCoach);
        if (!$lifeCoach) {
            return redirect('/')->with('error', 'lifeCoach not found.');
        }
        $input = $request->input();
        $lifeCoachStatus = $lifeCoach->update($input);
        if ($lifeCoachStatus) {
            return view('frontend.pages.life-coach.edit-life-coach' , [ 'lifeCoach' => $lifeCoach ])->with('success', 'lifeCoach successfully updated.');
        } else {
            return view('frontend.pages.life-coach.edit-life-coach', [ 'lifeCoach' => $lifeCoach ])->with('error', 'Oops something went wrong. lifeCoach not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function destroy($lifeCoach)
    {
        //
        //Get authenticated user and delete a specific lifeCoach
        $lifeCoach = LifeCoach::where(['id' => $lifeCoach])->first();
        $respStatus = $respMsg = '';
        if (!$lifeCoach) {
            $respStatus = 'error';
            $respMsg = 'lifeCoach not found';
        }
        $lifeCoachDelStatus = $lifeCoach->delete();
        if ($lifeCoachDelStatus) {
            $respStatus = 'success';
            $respMsg = 'lifeCoach deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. lifeCoach not deleted successfully';
        }
        return redirect('/')->with($respStatus, $respMsg);
    }
}
