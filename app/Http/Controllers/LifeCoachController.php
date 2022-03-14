<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Church;
use App\Models\Member;
use App\Models\LifeCoach;
use App\Models\AgeProfile;
use App\Models\FTGInterest;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\FollowupReason;
use App\Models\FollowupTarget;
use App\Models\LifeCoachTarget;
use App\Models\FTGInvitationMode;
use App\Models\FTGInformationNeed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LifeCoach\Store;
use App\Http\Requests\LifeCoach\Update;
use App\Http\Requests\LifeCoach\StoreAssign;

class LifeCoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coaches'] = LifeCoach::paginate(10);

        return view('pages.life-coaches.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.life-coaches.create');
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

        $lifeCoach = LifeCoach::create($input);

        return redirect()->route('life-coaches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function show($lifeCoach)
    {
        //Get authenticated user and display a single lifeCoach
        $lifeCoach = LifeCoach::with('followuptargets')->where(['id' => $lifeCoach])->first();
        // dd($lifeCoach);

        if (!$lifeCoach) {
            return redirect()->route('create-life-coach')->with('error', 'lifeCoach not found. Create missing coach');
        }
        return view('pages.life-coaches.show', ['lifeCoach' => $lifeCoach]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function edit(LifeCoach $lifeCoach) {
        return view('pages.life-coaches.edit' , [ 'lifeCoach' => $lifeCoach ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LifeCoach  $lifeCoach
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $lifeCoach) {

        $lifeCoach = LifeCoach::findOrFail($lifeCoach);

        $input = $request->input();
        $lifeCoachStatus = $lifeCoach->update($input);

        session()->flash('message', 'LifeCoach successfully updated.');
        return redirect()->route('life-coaches.index');
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
    
    /**
     * createTarget
     *
     * @param  mixed $coachId
     * @return void
     */
    public function createTarget($coachId) {
        $data['ageProfiles'] = AgeProfile::pluck('name', 'id');
        $data['churches'] = Church::pluck('name', 'id');
        $data['coach'] = LifeCoach::findOrfail($coachId);
        $data['maritalStatuses'] = MaritalStatus::pluck('name', 'id');
        $data['ftgInvitationModes'] = FTGInvitationMode::all();
        $data['fTGInterests'] = FTGInterest::all();
        $data['fTGInformationNeeds'] = FTGInformationNeed::all();

        return view('pages.life-coaches.create-modal', $data);
    }
    
    /**
     * createTargetStore
     *
     * @param  mixed $request
     * @return void
     */
    public function createTargetStore(Store $request) {

        $input = $request->input();

        $target = FollowupTarget::create($input);

        if ($request->fTGInterests) {
            $target->interests()->attach($request->fTGInterests);
        }

        if ($request->fTGInformationNeeds) {
            $target->information_needs()->attach($request->fTGInformationNeeds);
        }

        if ($request->ftgInvitationModes) {
            $target->invitation_modes()->attach($request->ftgInvitationModes);
        }

        LifeCoachTarget::where('followup_target_id', $request->target_id)->delete(); // delete existing attachments
        $target->lifecoaches()->attach($request->coach_id, ['reason_id' => $request->reason_id]);

        session()->flash('Followup Target successfully added and assigned.');

        return redirect()->back();
    }

    /**
     * assign
     *
     * @return void
     */
    public function assign(LifeCoach $lifeCoach) {

        $data['lifeCoach'] = $lifeCoach;

        $data['followupTargets'] = FollowupTarget::whereNotIn('id', function ($query) {
            $query->select('followup_target_id')
                ->from('life_coach_targets')
                ->pluck('followup_target_id')
                ->toArray();
        })->get();

        $data['followupReasons'] = FollowupReason::all();

        return view('pages.life-coaches.assign-target-modal', $data);
    }

    /**
     * assign
     *
     * @return void
     */
    public function assignStore(StoreAssign $request) {

        $lifeCoach = LifeCoach::findOrFail($request->coach_id);

        LifeCoachTarget::where('followup_target_id', $request->target_id)->delete(); // delete existing attachments
        $res = $lifeCoach->followuptargets()->attach($request->target_id, ['reason_id' => $request->reason_id]);
        
        // DB::table('life_coach_targets')->insert([
        //     'life_coach_id'      => $request->coach_id,
        //     'followup_target_id' => $request->target_id,
        //     'reason_id'          => $request->reason_id,
        //     'status'             => 1,
        //     'assigned_by'        => auth()->user()->id,
        //     'created_at'         => Carbon::now(),
        //     'updated_at'         => Carbon::now(),
        // ]);
        // dd($res);

        return redirect()->route('life-coaches.show', $lifeCoach);
    }
}
