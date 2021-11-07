<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\ExpenseHead;

class RetireRequisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['requisitions'] = Requisition::all();

        return view('retire-requisitions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['requisition'] = Requisition::find($id);

        return view('requisitions.retire', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function autocomplete(Request $request)
    {
        return Requisition::search($request->get('q'))->get();
    }


    /**
     * search for a member
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request) {
       // dd($request->all());

        $q = Requisition::query();

        // search by requisition number
        if ($request->has('requisition_number')) {
            $q->where('requisition_number', 'like', "%".$request->requisition_number."%");
        }

        // start and end dates
        if ($request->has('reason_id')) {
            $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $data['requisitions'] = $q->get();
        return view('retire-requisitions.search-results', $data);
    }
}
