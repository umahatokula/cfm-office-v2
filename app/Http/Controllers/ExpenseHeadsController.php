<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChartOfAccount;
use App\Models\ExpenseHead;

class ExpenseHeadsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Expense Head';
        $data['manage_expense_head'] = 1;
        $data['expense_heads'] = ExpenseHead::where(['church_id' => \Auth::user()->member->church_id])->get();
        return view('expense-heads.index', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Head';
        $data['manage_expense_head'] = 1;
        $data['expenses'] = ChartOfAccount::where(['id_parent' => 67])->orderby('item_title', 'asc')->pluck('item_title', 'id');
        
        return view('expense-heads.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
        'short_code'          => 'required', 
        'title'               => 'required', 
        'description'         => 'required', 
        'chart_of_account_id' => 'integer|required'
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
        $expenseHead                      = new ExpenseHead;
        $expenseHead->church_id           = \Auth::user()->member->church_id;
        $expenseHead->short_code          = $request->short_code;
        $expenseHead->title               = $request->title;
        $expenseHead->description         = $request->description;
        $expenseHead->chart_of_account_id = $request->chart_of_account_id;
        $expenseHead->save();

        session()->flash('successMessage', 'Expense Head added');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Expense Head added.' ]);
        }

        return redirect('expense-heads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Details Head';
        $data['manage_expense_head'] = 1;
        $data['expenses'] = ChartOfAccount::where(['id_parent' => 67])->pluck('item_title', 'id');
        $data['expense_head'] = ExpenseHead::find($id);

        return view('expense-heads.show', $data);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Head';
        $data['manage_expense_head'] = 1;
        $data['expenses'] = ChartOfAccount::where(['id_parent' => 67])->pluck('item_title', 'id');
        $data['expense_head'] = ExpenseHead::find($id);

        return view('expense-heads.edit', $data);        
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
        $rules=[
        'short_code'          => 'required', 
        'title'               => 'required', 
        'description'         => 'required', 
        'chart_of_account_id' => 'integer|required'
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
        $expenseHead                      = ExpenseHead::find($id);
        $expenseHead->church_id           = \Auth::user()->member->church_id;
        $expenseHead->short_code          = $request->short_code;
        $expenseHead->title               = $request->title;
        $expenseHead->description         = $request->description;
        $expenseHead->chart_of_account_id = $request->chart_of_account_id;
        $expenseHead->save();

        session()->flash('successMessage', 'Expense Head edited');

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Expense Head edited.' ]);
        }
        
        return redirect('expense-heads');
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

    public function activate($id) {
    	$expenseHead = ExpenseHead::find($id);
    	$expenseHead->status_id = 1;
    	$expenseHead->save();

    	session()->flash('successMessage', 'Expense Head activated.');
    	return redirect()->back();
    }

    public function deactivate($id) {
    	$expenseHead = ExpenseHead::find($id);
    	$expenseHead->status_id = 2;
    	$expenseHead->save();

    	session()->flash('successMessage', 'Expense Head deactivated.');
    	return redirect()->back();
    }
}
