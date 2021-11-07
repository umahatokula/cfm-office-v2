<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialRequisition;
use App\Models\RequisitionItem;
use App\Models\ExpenseHead;
use App\Models\AccountType;
use Carbon\Carbon;
use DateTime;

class SpecialRequisitionsController extends Controller
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
        $data['title'] = 'Special Requisitions';

        $data['specialRequisitionsMenu'] = 1;
        $data['requisitions'] = SpecialRequisition::where(['church_id' => \Auth::user()->member->church_id])->get();
        // dd($data);

        return view('special-requisitions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Requisitions';
        $data['expenseHeads'] = ExpenseHead::where(['status_id' => 1, 'church_id' => \Auth::user()->member->church_id])->pluck('title', 'id');
        $data['accountTypes'] = AccountType::where(['church_id' => \Auth::user()->member->church_id])->where('account_type', '!=', 'Tithes')->where('account_type', '!=', 'Operations')->pluck('account_type', 'id');

        return view('special-requisitions.create', $data);
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

        $rules=[
        'account_type_id'  => 'required',
        'expense_head_id'  => 'required',
        'description'      => 'required', 
        'requested_amount' => 'required',
        ];

        // $this->validate($request, $rules);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        // ExpenseHead::create($request->all())->save();
        $requisition                     = new SpecialRequisition;
        $requisition->requisition_number = $requisition->generateRequisitionNumber();
        $requisition->church_id          = \Auth::user()->member->church_id;
        $requisition->requested_amount   = $request->requested_amount;
        $requisition->requisition_by     = \Auth::user()->member->id;
        $requisition->account_type_id    = $request->account_type_id;
        $requisition->expense_head_id    = $request->expense_head_id;
        $requisition->description        = $request->description;
        $requisition->save();

        session()->flash('successMessage', 'Special Requisition submitted successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Special Requisition submitted successfully.' ]);
        }

        return redirect('special-requisitions');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Requisitions';
        $data['specialRequisitionsMenu'] = 1;
        $data['requisition'] = SpecialRequisition::find($id);
        // dd($data);

        return view('special-requisitions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Requisitions';
        $data['expenseHeads'] = ExpenseHead::where(['status_id' => 1, 'church_id' => \Auth::user()->member->church_id])->pluck('title', 'id');
        $data['accountTypes'] = AccountType::where(['church_id' => \Auth::user()->member->church_id])->where('account_type', '!=', 'Tithes')->where('account_type', '!=', 'Operations')->pluck('account_type', 'id');
        $data['requisition'] = SpecialRequisition::find($id);

        return view('special-requisitions.edit', $data);
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
        // dd($request->all());

        $rules=[
        'account_type_id'  => 'required',
        'expense_head_id'  => 'required',
        'description'      => 'required', 
        'requested_amount' => 'required',
        ];

        // $this->validate($request, $rules);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $validator->errors() ]);
            }

            return redirect()->back()->withInput()->withErrors($validator);
        }

        // ExpenseHead::create($request->all())->save();
        $requisition                     = SpecialRequisition::find($id);
        $requisition->requisition_number = $requisition->generateRequisitionNumber();
        $requisition->church_id          = \Auth::user()->member->church_id;
        $requisition->requested_amount   = $request->requested_amount;
        $requisition->requisition_by     = \Auth::user()->member->id;
        $requisition->account_type_id    = $request->account_type_id;
        $requisition->expense_head_id    = $request->expense_head_id;
        $requisition->description        = $request->description;
        $requisition->save();

        session()->flash('successMessage', 'Requisition edited successfully');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Requisition submitted successfully.' ]);
        }

        return redirect('special-requisitions');
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

    public function process($id) {
        $data['requisition'] = SpecialRequisition::find($id);

        return view('special-requisitions.process', $data);
    }

    public function approve(Request $request, $id) {
        $requisition = SpecialRequisition::find($id);
        $requisition->approved_amount = $request->approved_amount;
        $requisition->processed_by = \Auth::user()->member->id;
        $requisition->status_id = 3;
        $requisition->is_approved = 1;
        $requisition->save();

        // deduct approved amt from balance of operations account
        $account_type = AccountType::where(['id' => 4, 'church_id' => \Auth::user()->member->church_id])->first();
        $account_type->decrement('account_balance', $requisition->approved_amount);

        session()->flash('successMessage', 'Special Requisition approved.');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Special Requisition approved.' ]);
        }
        
        return redirect('special-requisitions');
    }

    public function decline($id) {
        $requisition = SpecialRequisition::find($id);
        $requisition->processed_by = \Auth::user()->member->id;
        $requisition->status_id = 5;
        $requisition->is_approved = 0;
        $requisition->save();

        session()->flash('successMessage', 'Special Requisition declined.');
        return redirect()->back();
    }

    /**
     * Show page to make payments
     * @return [type] [description]
     */
    public function pay() {
        $data['requisitions'] = SpecialRequisition::where(['church_id' => \Auth::user()->member->church_id])->get();
        $data['approved'] = [1 => 'Approved', 0 => 'Unapproved', -1 => 'All'];
        $data['status'] = [1 => 'Paid', 0 => 'Unpaid', -1 => 'All'];

        return view('special-requisitions.pay', $data);
    }

    /**
     * save payments
     * @return [type] [description]
     */
    public function payStore(Request $request, $id) {
        // dd($request->all(), $id);

        if($request->action == 'pay') {
            $requisition = SpecialRequisition::find($id);
            $requisition->paid_amount = $request->paid_amount;
            $requisition->paid_by = \Auth::user()->member->id;
            $requisition->status_id = 6;
            $requisition->is_paid = 1;
            $requisition->save();
            
            session()->flash('successMessage', 'Special Requisition paid.');
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Special Requisition paid.' ]);
            }
            
            return redirect('requisitions/show-pay');
        } else {
            $requisition = SpecialRequisition::find($id);
            $requisition->paid_amount = 0;
            $requisition->paid_by = \Auth::user()->member->id;
            $requisition->status_id = 7;
            $requisition->is_paid = 0;
            $requisition->save();

            // increase balance of operations account
            $account_type_operations = AccountType::where(['id' => 4, 'church_id' => \Auth::user()->member->church_id])->first();
            $account_type_operations->increment('account_balance', $requisition->approved_amount);
            
            session()->flash('successMessage', 'Special Requisition not paid.');
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Special Requisition not paid.' ]);
            }
            
            return redirect('requisitions/show-pay');

        }
    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function filter(Request $request) {
        // dd($request->all());

        $q = SpecialRequisition::query();

        if ($request->requisition_number) {
            // dd($request->requisition_number);
            $q->where('requisition_number', 'LIKE', "%".$request->requisition_number."%");
        }

        if ($request->has('start_date') && $request->has('end_date')) {

            $start_date = new DateTime($request->start_date);
            $end_date   = new DateTime($request->end_date);

            $startDate  = Carbon::instance($start_date);
            $endDate    = Carbon::instance($end_date);

            $q->whereBetween('created_at', [$startDate, $endDate]);

        }

        $requisitions = $q->get();

        return redirect('requisitions')->with('requisitions', $requisitions);
        // return view('requisitions.filter-results', $data);
    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function payFilter(Request $request) {
        // dd($request->all());

        $q = SpecialRequisition::query();

        if ($request->has('status')) {

          if ($request->status == -1) {
            $q->orWhere('is_paid', '=', 0);
            $q->orWhere('is_paid', '=', 1);
        } else {
            $q->where('is_paid', '=', $request->status);
        }

    }

    if ($request->has('approved')) {

      if ($request->approved == -1) {
        $q->orWhere('is_approved', '=', 0);
        $q->orWhere('is_approved', '=', 1);
    } else {
        $q->where('is_approved', '=', $request->approved);
    }

}

$requisitions = $q->get();

return redirect('requisitions/show-pay')->with('requisitions', $requisitions);
        // return view('requisitions.filter-results', $data);
}
}
