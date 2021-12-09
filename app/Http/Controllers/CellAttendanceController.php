<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CellMember;
use App\Models\CellAttendance;
use App\Models\Cell;
use App\Models\Month;
use Carbon\Carbon;

class CellAttendanceController extends Controller
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
        //
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
        // dd($request->all());

        foreach ($request->data as $cellMember) {
            $cellAttendance             = CellAttendance::where(['id' => $cellMember[0]])->first();
            // dd($cellAttendance, $cellMember[0], $request->year, $request->month_id);
            if ($cellAttendance) {
                $cellAttendance->name       = $cellMember[1];
                $cellAttendance->wk1_sun    = $cellMember[2];
                $cellAttendance->wk1_wed    = $cellMember[3];
                $cellAttendance->wk1_cell   = $cellMember[4];
                $cellAttendance->wk1_others = $cellMember[5];
                $cellAttendance->wk2_sun    = $cellMember[6];
                $cellAttendance->wk2_wed    = $cellMember[7];
                $cellAttendance->wk2_others = $cellMember[8];
                $cellAttendance->wk3_sun    = $cellMember[9];
                $cellAttendance->wk3_wed    = $cellMember[10];
                $cellAttendance->wk3_cell   = $cellMember[11];
                $cellAttendance->wk3_others = $cellMember[12];
                $cellAttendance->wk4_sun    = $cellMember[13];
                $cellAttendance->wk4_wed    = $cellMember[14];
                $cellAttendance->wk4_others = $cellMember[15];
                $cellAttendance->remark     = $cellMember[16];
                $cellAttendance->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Data successfully saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['cell'] = Cell::find($id);
        $data['months'] = Month::pluck('month', 'id');

        $now = Carbon::now();
        $ten_years_ago = $now->year - 10;
        $current_year = $now->year;

        for($i=$ten_years_ago ; $i <= $current_year ; $i++) {
            $data['years'][$i] = $i;
        }

        $year = Carbon::now()->year;
        $month_id = Carbon::now()->format('m');

        if (request('year')) {
            $year = request('year');
        }


        if (request('month_id')) {
            $month_id = request('month_id');
        }

        $data['year'] = $year;
        $data['month_id'] = $month_id;

        $data['cellAttendance'] = CellAttendance::where(['church_id' => \Auth::user()->member->church_id, 'cell_id' => $id, 'year' => $year, 'month_id' => $month_id])->get();

        return view('cell-attendance.attendance', $data);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAttendance($id, $year, $month_id)
    {
        // dd($id, $year, $month_id);
        $cellAttendance = CellAttendance::where(['church_id' => \Auth::user()->member->church_id, 'cell_id' => $id, 'year' => $year, 'month_id' => $month_id])->get();

        return response()->json(['success' => true, 'message' => 'Data successfully loaded', 'cellAttendance' => $cellAttendance]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $id)  {
        // dd($request->all(), $id);

        $cellMembers = CellMember::where('cell_id', $id)->get();

        foreach ($cellMembers as $cellMember) {
            $exists = CellAttendance::where(['year' => $request->year, 'month_id' => $request->month_id, 'cell_member_id' => $cellMember->id, 'cell_id' => $id, 'church_id' => \Auth::user()->member->church_id])->first();
            
            if (is_null($exists)) {
                // add to cell attendance
                $cellAttendance                 = new CellAttendance;
                $cellAttendance->church_id      = \Auth::user()->member->church_id;
                $cellAttendance->cell_member_id = $cellMember->id;
                $cellAttendance->cell_id        = $id;
                $cellAttendance->year           = $request->year;
                $cellAttendance->month_id       = $request->month_id;
                $cellAttendance->name           = $cellMember->name;
                $cellAttendance->save();
            }
        }

        session()->flash('successMessage', 'New Cell Attendance sheet created');
        return redirect()->back();
    }


}
