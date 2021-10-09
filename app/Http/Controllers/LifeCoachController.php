<?php

namespace App\Http\Controllers;

use App\Models\LifeCoach;
use App\Models\Member;
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
        // $member = Member::find(2);
        // $lifeCoach = [1, 2];
        // $member->lifecoaches()->attach($lifeCoach);

        // dd($member->lifecoaches);

        //Get authenticated user id
        $userId = Auth::user()->id;
        //Get authenticated user's list of lifeCoach's and paginate it
        $lifeCoaches = LifeCoach::where(['user_id' => $userId])->paginate(5);
        $members = Member::where(['user_id' => $userId])->paginate(5);
        $lifeCoach = LifeCoach::where(['user_id' => $userId])->paginate(5);

        return view('frontend.pages.dashboard.views.index', ['lifeCoaches' => $lifeCoaches]);
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
        //
        $userId = Auth::user()->id;
        $input = $request->input();
        $input['user_id'] = $userId;
        $lifeCoach = LifeCoach::create($input);

        //check if lifeCoach was created successfully or not and send a notification
        if ($lifeCoach) {
            $request->session()->flash('success', 'Life Coach successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, lifeCoach not saved');
        }

        return redirect('todo');
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
        //Get authenticated user and display a single lifeCoach
        $userId = Auth::user()->id;
        $lifeCoach = LifeCoach::where(['id' => $lifeCoach->id])->first();
        if (!$lifeCoach) {
            return redirect('todo')->with('error', 'lifeCoach not found');
        }
        return view('todo.view', ['lifeCoach' => $lifeCoach]);
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
        ////Get authenticated user and display lifeCoach to edit
        $userId = Auth::user()->id;
        $lifeCoach = LifeCoach::where(['user_id' => $userId, 'id' => $lifeCoach->id])->first();
        if ($lifeCoach) {
            return view('lifeCoach.edit', [ 'lifeCoach' => $lifeCoach ]);
        } else {
            return redirect('todo')->with('error', 'lifeCoach not found');
        }
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
        //Get authenticated user and update lifeCoach
        $userId = Auth::user()->id;
        $lifeCoach = LifeCoach::find($lifeCoach->id);
        if (!$lifeCoach) {
            return redirect('todo')->with('error', 'lifeCoach not found.');
        }
        $input = $request->input();
        $input['user_id'] = $userId;
        $lifeCoachStatus = $lifeCoach->update($input);
        if ($lifeCoachStatus) {
            return redirect('todo')->with('success', 'lifeCoach successfully updated.');
        } else {
            return redirect('todo')->with('error', 'Oops something went wrong. lifeCoach not updated');
        }
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
        //Get authenticated user and delete a specific lifeCoach
        $userId = Auth::user()->id;
        $lifeCoach = LifeCoach::where(['user_id' => $userId, 'id' => $lifeCoach->id])->first();
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
        return redirect('todo')->with($respStatus, $respMsg);
    }
}
