<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Church;
use App\Models\Status;
use App\Models\FollowUp;
use App\Models\AgeProfile;
use App\Models\AccountType;
use App\Models\ServiceType;
use App\Models\Transaction;
use Illuminate\Http\Request;
// use App\Models\PostServiceAccount;
use App\Models\ChurchService;
use App\Models\FollowupReason;
use App\Models\TransactionType;
use App\Events\TransactionOccured;
use Illuminate\Support\Facades\Auth;

define('TITHE', 10);
define('WELFARE', 25);
define('SAVINGS', 25);
define('OPERATIONS', 40);

class ChurchServicesController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['churchServiceInfoMenu'] = 1;
        $data['churches'] = Church::pluck('name', 'id');
        $data['serviceTypes'] = ServiceType::pluck('service_type', 'id');
        $date_from = Carbon::now()->startOfMonth();
        $date_to = Carbon::now()->endOfMonth();
        $data['church_id'] = null;
        $data['service_type_id'] = null;

        $q = ChurchService::query();

        if (\Auth::user()->hasPermissionTo('view all churches')) {
            $q->get();

            if ($request->church_id) {
                $q->where('church_id', $request->church_id);
                $data['church_id'] = $request->church_id;
            }
        } else {
            $q->where('church_id', \Auth::user()->member->church_id);
        }


        if ($request->service_type_id) {
            $q->where('service_type_id', $request->service_type_id);
            $data['service_type_id'] = $request->service_type_id;
        }


        if ($request->date_from) {
            $date_from = $request->date_from;
            $date_to = $request->date_to;
        }

        if ($date_from == $date_to) {
            $q->where('service_date', '=', Carbon::parse($date_from));
        } else {
            $q->whereBetween('service_date', [$date_from, $date_to]);
        }

        $data['churchServices'] = $q->orderBy('service_date', 'desc')->get();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        // dd($data['churchServices']->take(3));


        return view('pages.church-services.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['churchServiceInfoMenu']            = 1;
        $data['service_types']                    = ServiceType::pluck('service_type', 'id');

        return view('pages.church-services.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $rules                 = [
        'service_type_id'      => 'numeric|required',
        'service_date'         => 'required',
        'attendance_men'       => 'numeric|required',
        'attendance_women'     => 'numeric|required',
        'attendance_children'  => 'numeric|required',
        'first_timers_men'     => 'numeric|required',
        'first_timers_women'   => 'numeric|required',
        'first_timers_children'=> 'numeric|required',
        'born_again_men'       => 'numeric|required',
        'born_again_women'     => 'numeric|required',
        'born_again_children'  => 'numeric|required',
        'filled_men'           => 'numeric|required',
        'filled_women'         => 'numeric|required',
        'filled_children'      => 'numeric|required',
        'regular_offering'     => 'numeric|required',
        'tithes'               => 'numeric|required',
        'connection'           => 'numeric|required',
        'first_fruit'          => 'numeric|required',
        'thanksgiving_offering'=> 'numeric|required',
        'special_offering'     => 'numeric|required',
        'project_offering'     => 'numeric|required',
        'pos'                  => 'numeric|required',
        'honourarium'          => 'numeric|required',
        'others'               => 'numeric|required',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails()){
            if ($request->ajax()) {
                return response()->json(['success'=> FALSE, 'message' => $validator->errors() ]);
            }
            return \Redirect::back()->withInput()->withErrors($validator);

        }

        $data['ref_number']                       = $this->randomString(5);


        //save total monies to church account table as income
        $attendance_total                         = $request->attendance_men + $request->attendance_women + $request->attendance_children;
        $first_timers_total                       = $request->first_timers_men + $request->first_timers_women + $request->first_timers_children;
        $born_again_total                         = $request->born_again_men + $request->born_again_women + $request->born_again_children;
        $filled_total                             = $request->filled_men + $request->filled_women + $request->filled_children;
        $total_offering                           = $request->regular_offering + $request->tithes + $request->connection + $request->first_fruit + $request->thanksgiving_offering + $request->special_offering + $request->project_offering + $request->pos + $request->honourarium + $request->others;

        $churchService                            = new ChurchService;

        $churchService->church_id                 = \Auth::user()->member->church_id;
        $churchService->service_date              = $request->service_date;
        $churchService->service_type_id           = $request->service_type_id;
        $churchService->special_service           = $request->special_service;
        $churchService->attendance_men            = $request->attendance_men;
        $churchService->attendance_women          = $request->attendance_women;
        $churchService->attendance_children       = $request->attendance_children;
        $churchService->attendance_total          = $attendance_total;
        $churchService->first_timers_men          = $request->first_timers_men;
        $churchService->first_timers_women        = $request->first_timers_women;
        $churchService->first_timers_children     = $request->first_timers_children;
        $churchService->first_timers_total        = $first_timers_total;
        $churchService->born_again_men            = $request->born_again_men;
        $churchService->born_again_women          = $request->born_again_women;
        $churchService->born_again_children       = $request->born_again_children;
        $churchService->born_again_total          = $born_again_total;
        $churchService->filled_men                = $request->filled_men;
        $churchService->filled_women              = $request->filled_women;
        $churchService->filled_children           = $request->filled_children;
        $churchService->filled_total              = $filled_total;
        $churchService->regular_offering          = $request->regular_offering;
        $churchService->tithes                    = $request->tithes;
        $churchService->connection                = $request->connection;
        $churchService->first_fruit               = $request->first_fruit;
        $churchService->thanksgiving_offering     = $request->thanksgiving_offering;
        $churchService->special_offering          = $request->special_offering;
        $churchService->project_offering          = $request->project_offering;
        $churchService->pos                       = $request->pos;
        $churchService->honourarium               = $request->honourarium;
        $churchService->others                    = $request->others;
        $churchService->total_offering            = $total_offering;
        $churchService->submitted_by              = \Auth::user()->member_id;
        $churchService->admin_pastor_approval     = 4;
        $churchService->head_pastor_approval      = 4;
        $churchService->ref_number                = $data['ref_number'];
        $churchService->save();

        // fire event
        Transaction::prepTransactionEvent(name: 'offering', amount: $total_offering, description: 'Offerings', date: $churchService->service_date);

        // Apply financial policy - Post to different accounts
        // $this->financialPolicyEngine($churchService);

        // flash('Save was successful.')->success();
        return redirect()->route('church-services.index');
    }

    /**
    * divide total offering accordingly to post to the different account
    * Params [Object church, flag 0/1 0 is additio 1 is subtraction]
    */
    public function financialPolicyEngine($churchService, $flag = null) {
        // dd($churchService);

        $accountTypes = AccountType::where(['church_id' => \Auth::user()->member->church_id])->get();
        // dd($accountTypes[1]);

        // TITHE
        try{
            $tithe                                    = new PostServiceAccount;
            $tithe->church_id                         = $churchService->church_id;
            $tithe->church_service_id                 = $churchService->id;
            $tithe->account_type_id                   = 1;
            $tithe->amount                            = (TITHE / 100) * $churchService->total_offering;
            $tithe->posted_by                         = \Auth::user()->id;
            $tithe->save();
        } catch (\Illuminate\Database\QueryException $e){

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => 'AN error occured' ]);
            }

            flashy()->error('AN error occured');
            return redirect()->back()->withInput();
        }

        if (is_null($flag) || $flag == 0) {
            $accountTypes[0]->increment('account_balance', $tithe->amount);
        }

        if ($flag == 1) {
            $accountTypes[0]->decrement('account_balance', $tithe->amount);
        }


        // WELFARE
        try{
            $welfare                                  = new PostServiceAccount;
            $welfare->church_id                       = $churchService->church_id;
            $welfare->church_service_id               = $churchService->id;
            $welfare->account_type_id                 = 2;
            $welfare->amount                          = (WELFARE / 100) * $churchService->total_offering;
            $welfare->posted_by                       = \Auth::user()->id;
            $welfare->save();
        } catch (\Illuminate\Database\QueryException $e){

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => 'AN error occured' ]);
            }

            flashy()->error('AN error occured');
            return redirect()->back()->withInput();
        }


        if (is_null($flag) || $flag == 0) {
            $accountTypes[1]->increment('account_balance', $welfare->amount);
        }

        if ($flag == 1) {
            $accountTypes[1]->decrement('account_balance', $welfare->amount);
        }

        // SAVINGS
        try{
            $savings                                  = new PostServiceAccount;
            $savings->church_id                       = $churchService->church_id;
            $savings->church_service_id               = $churchService->id;
            $savings->account_type_id                 = 3;
            $savings->amount                          = (SAVINGS / 100) * $churchService->total_offering;
            $savings->posted_by                       = \Auth::user()->id;
            $savings->save();
        } catch (\Illuminate\Database\QueryException $e){

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => 'AN error occured' ]);
            }

            flashy()->error('AN error occured');
            return redirect()->back()->withInput();
        }


        if (is_null($flag) || $flag == 0) {
            $accountTypes[2]->increment('account_balance', $savings->amount);
        }

        if ($flag == 1) {
            $accountTypes[2]->decrement('account_balance', $savings->amount);
        }

        // OPERATIONS
        try{
            $operations                               = new PostServiceAccount;
            $operations->church_id                    = $churchService->church_id;
            $operations->church_service_id            = $churchService->id;
            $operations->account_type_id              = 4;
            $operations->amount                       = (OPERATIONS / 100) * $churchService->total_offering;
            $operations->posted_by                    = \Auth::user()->id;
            $operations->save();
        } catch (\Illuminate\Database\QueryException $e){

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => 'AN error occured' ]);
            }

            flashy()->error('AN error occured');
            return redirect()->back()->withInput();
        }


        if (is_null($flag) || $flag == 0) {
            $accountTypes[3]->increment('account_balance', $operations->amount);
        }

        if ($flag == 1) {
            $accountTypes[3]->decrement('account_balance', $operations->amount);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['churchService'] = ChurchService::find($id);

        return view('pages.church-services.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['churchServiceInfoMenu']            = 1;
        $data['service_types']                    = ServiceType::pluck('service_type', 'id');
        $data['churchService']                    = ChurchService::find($id);

        return view('pages.church-services.edit', $data);
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
        // dd(\Input                              ::all());

        $rules                                    = [
        'service_type_id'                         => 'numeric|required',
        'service_date'                            => 'required',
        'attendance_men'                          => 'numeric|required',
        'attendance_women'                        => 'numeric|required',
        'attendance_children'                     => 'numeric|required',
        'first_timers_men'                        => 'numeric|required',
        'first_timers_women'                      => 'numeric|required',
        'first_timers_children'                   => 'numeric|required',
        'born_again_men'                          => 'numeric|required',
        'born_again_women'                        => 'numeric|required',
        'born_again_children'                     => 'numeric|required',
        'filled_men'                              => 'numeric|required',
        'filled_women'                            => 'numeric|required',
        'filled_children'                         => 'numeric|required',
        'regular_offering'                        => 'numeric|required',
        'tithes'                                  => 'numeric|required',
        'connection'                              => 'numeric|required',
        'first_fruit'                             => 'numeric|required',
        'thanksgiving_offering'                   => 'numeric|required',
        'special_offering'                        => 'numeric|required',
        'project_offering'                        => 'numeric|required',
        'pos'                                     => 'numeric|required',
        'honourarium'                             => 'numeric|required',
        'others'                                  => 'numeric|required',
        ];

        $validator                                = \Validator::make($request->all(), $rules);

        if($validator->fails()){
            if ($request->ajax()) {
                return response()->json(['success'=> FALSE, 'message' => $validator->errors() ]);
            }
            return \Redirect                      ::back()->withInput()->withErrors($validator);

        }


        //save total monies to church account table as income
        $attendance_total                         = $request->attendance_men + $request->attendance_women + $request->attendance_children;
        $first_timers_total                       = $request->first_timers_men + $request->first_timers_women + $request->first_timers_children;
        $born_again_total                         = $request->born_again_men + $request->born_again_women + $request->born_again_children;
        $filled_total                             = $request->filled_men + $request->filled_women + $request->filled_children;
        $total_offering                           = $request->regular_offering + $request->tithes + $request->connection + $request->first_fruit + $request->thanksgiving_offering + $request->special_offering + $request->project_offering + $request->pos + $request->honourarium + $request->others;

        $churchService                            = ChurchService::find($id);

        $churchService->church_id                 = \Auth::user()->member->church_id;
        $churchService->service_date              = $request->service_date;
        $churchService->service_type_id           = $request->service_type_id;
        $churchService->special_service           = $request->special_service;
        $churchService->attendance_men            = $request->attendance_men;
        $churchService->attendance_women          = $request->attendance_women;
        $churchService->attendance_children       = $request->attendance_children;
        $churchService->attendance_total          = $attendance_total;
        $churchService->first_timers_men          = $request->first_timers_men;
        $churchService->first_timers_women        = $request->first_timers_women;
        $churchService->first_timers_children     = $request->first_timers_children;
        $churchService->first_timers_total        = $first_timers_total;
        $churchService->born_again_men            = $request->born_again_men;
        $churchService->born_again_women          = $request->born_again_women;
        $churchService->born_again_children       = $request->born_again_children;
        $churchService->born_again_total          = $born_again_total;
        $churchService->filled_men                = $request->filled_men;
        $churchService->filled_women              = $request->filled_women;
        $churchService->filled_children           = $request->filled_children;
        $churchService->filled_total              = $filled_total;
        $churchService->regular_offering          = $request->regular_offering;
        $churchService->tithes                    = $request->tithes;
        $churchService->connection                = $request->connection;
        $churchService->first_fruit               = $request->first_fruit;
        $churchService->thanksgiving_offering     = $request->thanksgiving_offering;
        $churchService->special_offering          = $request->special_offering;
        $churchService->project_offering          = $request->project_offering;
        $churchService->pos                       = $request->pos;
        $churchService->honourarium               = $request->honourarium;
        $churchService->others                    = $request->others;
        $churchService->total_offering            = $total_offering;
        $churchService->submitted_by              = \Auth::user()->member_id;
        $churchService->admin_pastor_approval     = 4;
        $churchService->head_pastor_approval      = 4;
        $churchService->ref_number                = $churchService->ref_number;
        $churchService->save();

        flash('Save was successful.')->success();
        return redirect()->route('church-services.index');
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
        $churchService                            = ChurchService::find($id);

        // Apply financial policy - Decrease from different accounts
        $this->financialPolicyEngine($churchService, 1);


        if ($churchService) {
            $churchService                        = $churchService->delete();

            if (\Request::ajax()) {
                return response()->json(['message'=> 'Church Service Information deleted']);
            }

            session()->flash('successMessage', 'Church Service Information deleted.');
            return redirect('church-services');

        } else {

            if (\Request::ajax()) {
                return response()->json(['message'=> 'Church Service Information was not found']);
            }

            session()->flash('errorMessage', 'Church Service Information was not found.');
            return redirect('church-services');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request->all());

        $q = ChurchService::query();

        // search by service type
        if ($request->service_type_id) {
            $q->where('service_type_id', '=', $request->service_type_id);
        }

        if (\Auth::user()->hasRole('generaloverseer') || \Auth::user()->hasRole('coordinatorchurches')) {
            $churchServices = $q->get();
        }
        else
        {
            $churchServices = $q->where('church_id', \Auth::user()->member->church_id)->get();
        }


        return redirect()->route('church-services.index')->with('churchServices', $churchServices);
        // return view('church-services.search-results', $data);
    }

    /**
     * @param  church serivce info approval by admin pastor
     * @return [type]
     */
    public function adminPastorApprove($id) {
        $churchService = ChurchService::find($id);
        $churchService->admin_pastor_approval = 3;
        $churchService->save();

        session()->flash('successMessage', 'Approved');
        return redirect()->route('church-services.index');
    }

    /**
     * @param  church serivce info approval by admin pastor
     * @return [type]
     */
    public function headPastorApprove($id) {
        $churchService = ChurchService::find($id);
        $churchService->head_pastor_approval = 3;
        $churchService->save();

        session()->flash('successMessage', 'Approved');
        return redirect()->route('church-services.index');
    }

    /*
     * Create a random string
     * @author  XEWeb <>
     * @param $length the length of the string to create
     * @return $str the string
     */
    function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    /**
     * Export church service summary as PDF
     */
    function churchServicePDF($date_from, $date_to, $service_type_id = null, $church_id = null) {

        $q = ChurchService::query();

        if (\Auth::user()->hasPermissionTo('view all churches')) {
            $q->get();

            if ($church_id) {
                $q->where('church_id', $church_id);
                $data['church_id'] = $church_id;
                $data['church'] = Church::find($church_id);
            }
        }
        else
        {
            $data['church'] = Church::find(\Auth::user()->member->church_id);
            $q->where('church_id', \Auth::user()->member->church_id);
        }

        if ($service_type_id) {
            $q->where('service_type_id', $service_type_id);
            $data['service_type_id'] = $service_type_id;
        }

        $q->whereBetween('service_date', [$date_from, $date_to]);

        $data['churchServices'] = $q->orderBy('service_date', 'desc')->get();
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        $pdf = \PDF::loadView('pdf.churchService', $data)->setPaper('a4', 'landscape');
        if (\Auth::user()->hasPermissionTo('view all churches')) {
            return $pdf->download('SERVICE_REPORTS.pdf');
        } else {
            return $pdf->download('SERVICE_REPORT_'.$data['church']->name.'.pdf');
        }
    }

    /**
     * Export church service summary as PDF
     */
    function churchServiceDetailsPDF($id, $date_from, $date_to) {

    }
}
