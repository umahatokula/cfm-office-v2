<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryScheduleElement;
use App\Http\Requests\SalaryScheduleElement\StoreRequest;

class SalaryScheduleElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['elements'] = SalaryScheduleElement::active()->paginate(20);

        return view('pages.salariesScheduleElements.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.salariesScheduleElements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // dd($request->all());
        $salaryScheduleElement = new SalaryScheduleElement;
        $salaryScheduleElement->name = $request->name;
        $salaryScheduleElement->increase_net_salary = $request->has('increase_net_salary') ? 1 : 0;
        $salaryScheduleElement->status = $request->status;
        $salaryScheduleElement->save();
        
        session()->flash('success', 'Saved');

        return redirect()->route('salaries-schedule-elements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryScheduleElement  $salaryScheduleElement
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryScheduleElement $salaries_schedule_element)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryScheduleElement  $salaryScheduleElement
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryScheduleElement $salaries_schedule_element)
    {
        $data['salaryScheduleElement'] = $salaries_schedule_element;

        return view('pages.salariesScheduleElements.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryScheduleElement  $salaryScheduleElement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryScheduleElement $salaries_schedule_element)
    {
        // dd($salaries_schedule_element);
        $salaries_schedule_element->name = $request->name;
        $salaries_schedule_element->increase_net_salary = $request->has('increase_net_salary') ? 1 : 0;
        $salaries_schedule_element->status = $request->status;
        $salaries_schedule_element->save();
        
        session()->flash('success', 'Updated');

        return redirect()->route('salaries-schedule-elements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryScheduleElement  $salaryScheduleElement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryScheduleElement $salaries_schedule_element)
    {
        dd($salaries_schedule_element);
    }
}
