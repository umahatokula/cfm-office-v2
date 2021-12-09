<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\ServiceTeam;
use App\Models\ChurchRole;
use App\Models\MemberMinistry;
use App\Models\MemberChurchRole;

class InvolvementsController extends Controller
{
    public function show($id) {
    	$data['ministries'] =  Ministry::all();
    	$data['serviceTeams'] =  ServiceTeam::all();
    	$data['churchRoles'] =  ChurchRole::all();
    	$data['member'] =  Member::find($id);
    	$data['myMinistries'] =  MemberMinistry::where('member_id', $id)->pluck('ministry_id')->toArray();
    	$data['myChurchRoles'] =  MemberChurchRole::where('member_id', $id)->pluck('church_role_id')->toArray();

    	return view('involvements.show', $data);
    }
}
