<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberFamily;
use App\Models\Family;

class FamilyController extends Controller
{
	public function show($id) {
		$data['member'] = Member::find($id);
		$data['members'] = Member::select(\DB::raw('concat (lname," ",fname) as full_name, id'))->where('church_id', \Auth::user()->member->church_id)->orderBy('lname', 'asc')->pluck('full_name', 'id');
    $myFamily = MemberFamily::where('member_id', $data['member']->id)->first();
    $data['families'] = Family::where('church_id', \Auth::user()->member->church_id)->pluck('household', 'id');
    if($myFamily) {
     $data['familyMembers'] = MemberFamily::where('family_id', $myFamily->family_id)->get();
   } else {
     $data['familyMembers'] = [];
   }

   return view('family.show', $data);
 }

    /**
     * find a church member to add to a family
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function findMember(Request $request) {
    	return Member::find($request->member_id);
    }

    /**
     * find a church member to add to a family
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function addMemberToFamily(Request $request) {
    	// dd($request->all());    	

        // do this if an existing household was NOT selected
    	if ($request->household_id == "") {
            // clean up household name
            $household = trim(str_replace('(auto generated)', '', $request->household));
            // delete existing family
            $existingFamily = \DB::table('families')->where('household', $household)->first();
            if ($existingFamily) {
            $delete = \DB::table('member_families')->where('family_id', $existingFamily->id)->delete();
            $delete = \DB::table('families')->where('household', $household)->delete();
            }
            
            //save family info
            $family = new Family;
            $family->household          = $household;
            $family->contact_person     = $request->contact_person;
            $family->church_id          = \Auth::user()->member->church_id;
            $family->save();
            
            // save family members
            for ($i=0; $i < count($request->member_id); $i++) { 
            $memberFamily = new MemberFamily;
            $memberFamily->member_id = $request->member_id[$i];
            $memberFamily->family_id = $family->id;
            $memberFamily->is_parent = $request->is_parent[$i];
            $memberFamily->save();
            }
            
            return $family;
      }

        // do this if an existing household was selected
      if ($request->household_id != "") {
            $family = Family::find($request->household_id);
            
            // delete existing members
            // $delete = \DB::table('member_families')->where('family_id', $family->id)->delete();
            
            // save family members
            try{
            for ($i=0; $i < count($request->member_id); $i++) { 
            $memberFamily = new MemberFamily;
            $memberFamily->member_id = $request->member_id[$i];
            $memberFamily->family_id = $family->id;
            $memberFamily->is_parent = $request->is_parent[$i];
            $memberFamily->save();
            }
            } catch (\Exception $e) {
            if($e->errorInfo[1] ==  1062) {
            // session()->flash('warningMessage', 'Some members you tried to add already exist as members of this family');
            }
            }
            
            return $family;
      }
    }


  function deleteFamilyMember(Request $request) {
        // dd($request->all());

    $memberFamily = MemberFamily::where('member_id', $request->id)->first();

    if ($memberFamily) {
      $delete = \DB::table('member_families')->where('member_id', $request->id)->delete();

      return ['msg' => 'Member delete.'];;
    } else {
      return ['msg' => 'Member not found'];
    }
  }
}
