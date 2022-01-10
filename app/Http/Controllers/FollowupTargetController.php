<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\LifeCoach;
use App\Models\AgeProfile;
use Illuminate\Http\Request;
use App\Models\FollowupReason;
use App\Models\LifeCoachTarget;
use App\Models\FollowupTarget;
use App\Http\Requests\FollowupTarget\Store;
use App\Http\Requests\FollowupTarget\Update;
use App\Http\Requests\FollowupTarget\StoreAssign;

class FollowupTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['followupTargets'] = FollowupTarget::paginate(5);

        return view('pages.follow-up.targets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['ageProfiles'] = AgeProfile::pluck('name', 'id');
        $data['churches'] = Church::pluck('name', 'id');

        if(request()->ajax()) {
            return view('pages.follow-up.targets.create-modal', $data);
        }

        return view('pages.follow-up.targets.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $input = $request->input();

        $followupTarget = FollowupTarget::create($input);

        session()->flash('FollowupTarget successfully added.');
        // return redirect()->route('followup-targets.index');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function show($followupTarget)
    {
        $data['followupTarget'] = FollowupTarget::findOrFail($followupTarget);

        if (request()->ajax()) {
            return view('pages.follow-up.targets.show-modal', $data);
        }

        return view('pages.follow-up.targets.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function edit($followupTarget)
    {
        $data['followUpTarget'] = FollowupTarget::findOrFail($followupTarget);
        $data['ageProfiles'] = AgeProfile::pluck('name', 'id');
        $data['churches'] = Church::pluck('name', 'id');

        return view('pages.follow-up.targets.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $followupTarget)
    {
        $follow_up_target = FollowupTarget::findOrFail($followupTarget);

        $input = $request->input();
        $followupTarget = $follow_up_target->update($input);

        session()->flash('Followup Target successfully updated.');
        return redirect()->route('followup-targets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowupTarget  $followupTarget
     * @return \Illuminate\Http\Response
     */
    public function delete(FollowupTarget $followupTarget) {
        $follow_up_target = FollowupTarget::findOrFail($followupTarget->id)->delete();

        session()->flash('FollowupTarget deleted successfully');
        return redirect()->route('followup-targets.index');
    }

    /**
     * assign
     *
     * @return void
     */
    public function assign(FollowupTarget $followupTarget) {

        $data['target'] = FollowupTarget::findOrFail($followupTarget->id);
        $data['lifeCoaches'] = LifeCoach::all();
        $data['followupReasons'] = FollowupReason::all();

        return view('pages.follow-up.targets.assign-target-modal', $data);
    }

    /**
     * assign
     *
     * @return void
     */
    public function assignStore(StoreAssign $request) {

        $target = FollowupTarget::findOrFail($request->target_id);

        LifeCoachTarget::where('followup_target_id', $request->target_id)->delete(); // delete existing attachments
        $target->lifecoaches()->attach($request->coach_id, ['reason_id' => $request->reason_id]);

        return redirect()->route('followup-targets.index');
    }
}
