<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Cell;
use App\Models\CellLeader;
use App\Models\Region;
use App\Models\AgeProfile;
use App\Models\WeeklyCellMeetingReport;
use App\Models\WeeklyCellMeetingProgramSummary;
use App\Models\CellMember;
use App\Models\CellQuarterlyFollowup;
use App\Models\CellQuarterlyFollowupFollowedUp;
use App\Models\CellQuarterlyFollowupNCBI;
use App\Models\CellQuarterlyFollowupPastoralCare;
use App\Models\CellQuarterlyFollowupSoulsWon;
use App\Models\Church;
use Carbon\Carbon;
use DB;

class CellsController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('cells.filtered');
    }

    /**
     * filter cells to show by church
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function filtered($church_id = null) {
        // dd(request('church_id'));

        $church_id = request('church_id');

        if ($church_id) {

            $church = Church::find($church_id);

            $data['cellMenu']    = 1;
            $data['cells']       = Cell::where('church_id', $church->id)->get();
            $data['members']     = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
            $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');
            $data['regions']     = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');
            $data['churches']    = Church::pluck('name', 'id');
            // dd($data);

            return view('cells.index', $data);
        } else {

            $data['cellMenu']    = 1;
            $data['cells']       = Cell::where('church_id', \Auth::user()->member->church_id)->get();
            $data['members']     = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
            $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');
            $data['regions']     = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');
            $data['churches']    = Church::pluck('name', 'id');
            // dd($data);

            return view('cells.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['cellMenu'] = 1;
        $data['cells'] = Cell::where('church_id', \Auth::user()->member->church_id)->get();
        $data['members'] = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
        $data['ageProfiles'] = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');
        $data['regions'] = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');

        return view('cells.create', $data);
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
        $rules = [
            'name'                 => 'required',
            'address'              => 'required',
            'meeting_time'         => 'required',
            'meeting_day'          => 'required',
            'region_id'            => 'required',
            'leader_member_id'     => 'required',
            'leader_attended_clot' => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $cell = new Cell;
        $cell->name           = $request->name;  
        $cell->description    = $request->description;   
        $cell->address        = $request->address; 
        $cell->meeting_time    = $request->meeting_time;
        $cell->meeting_day    = $request->meeting_day;
        $cell->church_id      = \Auth::user()->member->church_id;
        $cell->age_profile_id = $request->age_profile_id;
        $cell->region_id      = $request->region_id;
        $cell->save();

        //  save cell leader
        $cell_leader                = new CellLeader;
        $cell_leader->church_id     = \Auth::user()->member->church_id;
        $cell_leader->cell_id       = $cell->id;
        $cell_leader->member_id     = $request->leader_member_id;   
        $cell_leader->attended_clot = $request->leader_attended_clot;
        $cell_leader->is_leader     = 1;
        $cell_leader->save();

        $member = Member::find($request->leader_member_id);
        $member->cell_id = $cell->id;
        $member->save();

        // save assistant cell leader
        if ($request->assistant_member_id) {
            $assistant_cell_leader                = new CellLeader;
            $assistant_cell_leader->church_id     = \Auth::user()->member->church_id;
            $assistant_cell_leader->cell_id       = $cell->id;  
            $assistant_cell_leader->member_id     = $request->assistant_member_id;   
            $assistant_cell_leader->attended_clot = $request->assistant_attended_clot;
            $assistant_cell_leader->is_leader     = 0;
            $assistant_cell_leader->save();
        }


        session()->flash('successMessage', "Cell added");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cell added.' ]);
        }

        return redirect('cells');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['cellMenu']      = 1;
        $data['cell']          = Cell::find($id);
        $data['cellLeader']    = CellLeader::where(['church_id' => \Auth::user()->member->church_id, 'is_leader' => 1])->first();
        $data['assCellLeader'] = CellLeader::where(['church_id' => \Auth::user()->member->church_id, 'is_leader' => 0])->first();

        return view('cells.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['cellMenu']      = 1;
        $data['cells']         = Cell::where('church_id', \Auth::user()->member->church_id)->get();
        $data['members']       = Member::where('church_id', \Auth::user()->member->church_id)->pluck('full_name', 'id');
        $data['ageProfiles']   = AgeProfile::where('church_id', \Auth::user()->member->church_id)->pluck('age_profile', 'id');
        $data['regions']       = Region::where('church_id', \Auth::user()->member->church_id)->pluck('region', 'id');
        $data['cell']          = Cell::find($id);
        $data['cellLeader']    = CellLeader::where(['church_id' => \Auth::user()->member->church_id, 'is_leader' => 1])->first();
        $data['assCellLeader'] = CellLeader::where(['church_id' => \Auth::user()->member->church_id, 'is_leader' => 0])->first();

        return view('cells.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $rules = [
            'name'                 => 'required',
            'address'              => 'required',
            'meeting_day'          => 'required',
            'meeting_time'         => 'required',
            'region_id'            => 'required',
            'leader_member_id'     => 'required',
            'leader_attended_clot' => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $cell = Cell::find($id);
        $cell->name           = $request->name;  
        $cell->description    = $request->description;   
        $cell->address        = $request->address; 
        $cell->meeting_day    = $request->meeting_day; 
        $cell->meeting_time    = $request->meeting_time;
        $cell->church_id      = \Auth::user()->member->church_id;
        $cell->age_profile_id = $request->age_profile_id;
        $cell->region_id      = $request->region_id;
        $cell->save();

        // delete previous cell leaders for this cell
        $cellLeaders = DB::table('cell_leaders')->where(['church_id' => \Auth::user()->member->church_id, 'cell_id' => $cell->id])->delete();

        //  save cell leader
        $cell_leader                = new CellLeader;
        $cell_leader->church_id     = \Auth::user()->member->church_id;
        $cell_leader->cell_id       = $cell->id;
        $cell_leader->member_id     = $request->leader_member_id;   
        $cell_leader->attended_clot = $request->leader_attended_clot;
        $cell_leader->is_leader     = 1;
        $cell_leader->save();

        $member = Member::find($request->leader_member_id);
        $member->cell_id = $cell->id;
        $member->save();

        // save assistant cell leader
        if ($request->assistant_member_id) {
            $assistant_cell_leader                = new CellLeader;
            $assistant_cell_leader->church_id     = \Auth::user()->member->church_id;
            $assistant_cell_leader->cell_id       = $cell->id;  
            $assistant_cell_leader->member_id     = $request->assistant_member_id;   
            $assistant_cell_leader->attended_clot = $request->assistant_attended_clot;
            $assistant_cell_leader->is_leader     = 0;
            $assistant_cell_leader->save();
        }


        session()->flash('successMessage', "Cell edited");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cell edited.' ]);
        }

        return redirect('cells');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cell = Cell::find($id);

        if ($cell) {
            $cell = $cell->delete();

            if (\Request::ajax()) {
                return response()->json(['message' => 'Cell deleted']);
            }

            session()->flash('successMessage', 'Cell deleted.');
            return redirect()->back();

        } else {

            if (\Request::ajax()) {
                return response()->json(['message' => 'Cell was not found']);
            }

            session()->flash('errorMessage', 'Cell was not found.');
            return redirect()->back();
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suggest($member_id)
    {
        $member = Member::find($member_id);

        $data['member'] = $member;

        $q = Cell::query();

        // search for likely cells based on member's age profile
        // $q->where('age_profile_id', 'like', "%".$member->age_profile_id."%");

        // search for likely cells based on member's region
        $q->where('region_id', 'like', "%".$member->region_id."%");

        $data['suggestedCells'] = $q->get();

        $data['cells'] = Cell::where('church_id', \Auth::user()->member->church_id)->get();

        // return ['success' => true, 'suggestedCells' => $suggestedCells, 'cells' => Cell::all() ];
        return view('cells.suggest', $data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leaderProfile($id)
    {
        $data['profile'] = Member::find($id);

        if (empty($data['profile'])) {
            return \Redirect::to('error');
        }


        $data['title'] = $data['profile']->fname;
        $data['manage_members'] = 1;

        return view('cells.leader-profile', $data);
    }

    /**
     * store weekly cell meeting report
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showReportForm($id) {
        $data['cell'] = Cell::find($id);

        for($i = 0 ; $i < 12 ; $i++ ) {
            $data['months'][$i+1] = $i + 1;
        }

        for($i = 0 ; $i < 31 ; $i++ ) {
            $data['days'][$i+1] = $i + 1;
        }

        $currentYear = Date('Y');
        for($i = ($currentYear - 2) ; $i <= $currentYear ; $i++ ) {
            $data['years'][$i] = $i;
        }

        return view('cells.create-report', $data);
    }

    /**
     * store weekly cell meeting report
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeReport(Request $request) {
        // dd($request->all());

        $rules = [
            'week'               => 'required',
            'program'            => 'required',
            'venue'              => 'required',
            'start_time'         => 'required',
            'end_time'           => 'required',
            'total_attendance'   => 'required',
            'first_time_guests'  => 'required',
            'offering_and_seeds' => 'required',
            'message_summary'    => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $date_held = $request->day.'-'.$request->month.'-'.$request->year;
        $date_held =  Carbon::parse($date_held);
        // dd( $date_held);

        $weeklyReport                           = new WeeklyCellMeetingReport;
        $weeklyReport->date_held                = $date_held;
        $weeklyReport->church_id                = \Auth::user()->member->church_id;
        $weeklyReport->cell_id                  = $request->cell_id;
        $weeklyReport->week                     = $request->week;
        $weeklyReport->program                  = $request->program;
        $weeklyReport->venue                    = $request->venue;
        $weeklyReport->start_time               = $request->start_time;
        $weeklyReport->end_time                 = $request->end_time;
        $weeklyReport->total_attendance         = $request->total_attendance;
        $weeklyReport->first_time_guests        = $request->first_time_guests;
        $weeklyReport->offering_and_seeds       = $request->offering_and_seeds;
        $weeklyReport->message_summary          = $request->message_summary;
        $weeklyReport->other_reports            = $request->other_reports;
        $weeklyReport->cell_leader_comment      = $request->cell_leader_comment;
        $weeklyReport->pastor_in_charge_comment = $request->pastor_in_charge_comment;
        $weeklyReport->resident_pastor_comment  = $request->resident_pastor_comment;
        $weeklyReport->save();

        for ($i=0; $i < count($request->event); $i++) { 
            $programSummary                                = new WeeklyCellMeetingProgramSummary;
            $programSummary->weekly_cell_meeting_report_id = $weeklyReport->id;
            $programSummary->event                          = $request->event[$i];
            $programSummary->from                          = $request->from[$i];
            $programSummary->to                            = $request->to[$i];
            $programSummary->coordinator                   = $request->coordinator[$i];
            $programSummary->save();
        }

        session()->flash('successMessage', "Weekly Cell Meeting Report submitted");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Weekly Cell Meeting Report submitted' ]);
        }

        return redirect()->route('cells.show', $weeklyReport->cell_id);

    }

    /**
     * store weekly cell meeting report
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editReportForm($id) {
        $data['weeklyReport'] = WeeklyCellMeetingReport::find($id);

        for($i = 0;  $i < 12; $i++) {
            $data['months'][$i+1] = $i +   1;
        }

        for($i = 0;  $i < 31; $i++) {
            $data['days'][$i+1] = $i +   1;
        }

        $currentYear = Date('Y');
        for($i = ($currentYear - 2); $i <= $currentYear; $i++) {
            $data['years'][$i] = $i;
        }

        $data['day'] =$data['weeklyReport']->date_held->day;
        $data['month'] = $data['weeklyReport']->date_held->month;
        $data['year'] = $data['weeklyReport']->date_held->year;


        return view('cells.edit-report', $data);
    }

    /**
     * store weekly cell meeting report
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateReport(Request $request, $id) {
        // dd($request->all());

        $rules = [
            'week'               => 'required',
            'program'            => 'required',
            'venue'              => 'required',
            'start_time'         => 'required',
            'end_time'           => 'required',
            'total_attendance'   => 'required',
            'first_time_guests'  => 'required',
            'offering_and_seeds' => 'required',
            'message_summary'    => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $date_held = $request->day.'-'.$request->month.'-'.$request->year;
        $date_held =  Carbon::parse($date_held);
        // dd( $date_held);

        $weeklyReport                           = WeeklyCellMeetingReport::find($id);
        $weeklyReport->date_held                = $date_held;
        $weeklyReport->church_id                = \Auth::user()->member->church_id;
        $weeklyReport->cell_id                  = $request->cell_id;
        $weeklyReport->week                     = $request->week;
        $weeklyReport->program                  = $request->program;
        $weeklyReport->venue                    = $request->venue;
        $weeklyReport->start_time               = $request->start_time;
        $weeklyReport->end_time                 = $request->end_time;
        $weeklyReport->total_attendance         = $request->total_attendance;
        $weeklyReport->first_time_guests        = $request->first_time_guests;
        $weeklyReport->offering_and_seeds       = $request->offering_and_seeds;
        $weeklyReport->message_summary          = $request->message_summary;
        $weeklyReport->other_reports            = $request->other_reports;
        $weeklyReport->cell_leader_comment      = $request->cell_leader_comment;
        $weeklyReport->pastor_in_charge_comment = $request->pastor_in_charge_comment;
        $weeklyReport->resident_pastor_comment  = $request->resident_pastor_comment;
        $weeklyReport->save();

        // delete existing entries
        DB::table('weekly_cell_meeting_program_summaries')->where('weekly_cell_meeting_report_id', $weeklyReport->id)->delete();

        for ($i=0; $i < count($request->event); $i++) { 
            $programSummary                                = new WeeklyCellMeetingProgramSummary;
            $programSummary->weekly_cell_meeting_report_id = $weeklyReport->id;
            $programSummary->event                          = $request->event[$i];
            $programSummary->from                          = $request->from[$i];
            $programSummary->to                            = $request->to[$i];
            $programSummary->coordinator                   = $request->coordinator[$i];
            $programSummary->save();
        }

        session()->flash('successMessage', "Weekly Cell Meeting Report updated");

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Weekly Cell Meeting Report updated' ]);
        }

        return redirect()->route('cells.show', $weeklyReport->cell_id);

    }

    /**
     * show details of weekly cell meeting report
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function weeklyReportDetails($id) {
        // return WeeklyCellMeetingReport::with('programSummaries')->where('id', $id)->first();

        $weeklyReport = WeeklyCellMeetingReport::find($id);
        $programSummaries = $weeklyReport->programSummaries;

        // if (request()->expectsJson()) {
        //     return ['weeklyReport' => $weeklyReport, 'programSummaries' => $programSummaries];
        // }

        $data['weeklyReport'] = $weeklyReport;
        $data['programSummaries'] = $programSummaries;

        return view('cells.showreport', $data);
    }


    /**
     * show form for quarterly follow-up
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function quarterlyFollowup($id) {
        $data['cell'] = Cell::find($id);

        return view('cells.quarterly-follow-up', $data);
    }


    /**
     * show form for quarterly follow-up
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function storeQuarterlyFollowup(Request $request) {
        // dd($request->all());

        $rules = [
            'total_souls_won'          => 'required',
            'total_by_pastoral_care'   => 'required',
            'total_retained'           => 'required',
            'total_constant_in_church' => 'required',
            'total_NCBI'               => 'required',
            'total_followed_up'        => 'required',
        ];

        // $this->validate($request,$rules);
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('name') ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $quarterlyFollowup                           = new CellQuarterlyFollowup;
        $quarterlyFollowup->church_id                = \Auth::user()->member->church_id;
        $quarterlyFollowup->total_souls_won          = $request->total_souls_won;
        $quarterlyFollowup->total_by_pastoral_care   = $request->total_by_pastoral_care;
        $quarterlyFollowup->total_retained           = $request->total_retained;
        $quarterlyFollowup->total_constant_in_church = $request->total_constant_in_church;
        $quarterlyFollowup->total_NCBI               = $request->total_NCBI;
        $quarterlyFollowup->total_followed_up        = $request->total_followed_up;
        $quarterlyFollowup->save();

        for ($i=0; $i < count($request->sw_name); $i++) { 
            $soulsWon                             = new CellQuarterlyFollowupSoulsWon;
            $soulsWon->cell_quarterly_followup_id = $quarterlyFollowup->id;
            $soulsWon->sw_name                    = $request->sw_name[$i];
            $soulsWon->sw_phone                   = $request->sw_phone[$i];
            $soulsWon->sw_address                 = $request->sw_address[$i];
            $soulsWon->save();
        }

        for ($i=0; $i < count($request->fu_name); $i++) { 
            $followedUp                             = new CellQuarterlyFollowupFollowedUp;
            $followedUp->cell_quarterly_followup_id = $quarterlyFollowup->id;
            $followedUp->fu_name                    = $request->fu_name[$i];
            $followedUp->fu_phone                   = $request->fu_phone[$i];
            $followedUp->fu_address                 = $request->fu_address[$i];
            $followedUp->fu_followed_up_by          = $request->fu_followed_up_by[$i];
            $followedUp->save();
        }

        for ($i=0; $i < count($request->ncbi_name); $i++) { 
            $ncbi                             = new CellQuarterlyFollowupNCBI;
            $ncbi->cell_quarterly_followup_id = $quarterlyFollowup->id;
            $ncbi->ncbi_name                  = $request->ncbi_name[$i];
            $ncbi->ncbi_phone                 = $request->ncbi_phone[$i];
            $ncbi->ncbi_level                 = $request->ncbi_level[$i];
            $ncbi->save();
        }

        for ($i=0; $i < count($request->pc_name); $i++) { 
            $pc                             = new CellQuarterlyFollowupPastoralCare;
            $pc->cell_quarterly_followup_id = $quarterlyFollowup->id;
            $pc->pc_name                    = $request->pc_name[$i];
            $pc->pc_phone                   = $request->pc_phone[$i];
            $pc->pc_address                 = $request->pc_address[$i];
            $pc->save();
        }

        session()->flash('successMessage', 'Quarterly follow-up report saved');
        return redirect()->route('cells.show', $request->cell_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteReportForm($id)
    {
        $report = WeeklyCellMeetingReport::find($id);

        if ($report) {
            $report->delete();
        }

        return redirect()->back();
    }
}
