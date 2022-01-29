<?php

namespace App\Http\Livewire\Accounting\SalarySchedule;

use Livewire\Component;
use App\Models\SalarySchedule;
use App\Models\SalaryScheduleElement;
use App\Models\SalaryScheduleComponent;

class CreateSchedule extends Component
{
    public $name, $status;
    public $scheduleElements = [];
    public $salaryScheduleElements;

    protected $rules=[
        'name'     => 'required',
    ];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        
        $this->salaryScheduleElements = SalaryScheduleElement::all();
        $this->addScheduleElement();

    }
    
    /**
     * add requisition
     *
     * @return void
     */
    public function addScheduleElement() {
        $this->scheduleElements[] = [
            'salary_schedule_element_id' => null,
            'amount' => null,
        ];
    }
    
    /**
     * remove requisition
     *
     * @param  mixed $index
     * @return void
     */
    public function removeScheduleElement($key) {
        array_key_exists($key, $this->scheduleElements) ? array_splice($this->scheduleElements, $key, 1) : null;
    }

    public function getTotal() {
        return array_sum(array_column($this->scheduleElements, 'amount'));
    }

    public function save() {
        $this->validate();
        
        $total = $this->getTotal();
    
        // ExpenseHead::create($request->all())->save();
        $salarySchedule = new SalarySchedule;
        $salarySchedule->name       = $this->name;
        $salarySchedule->status     = $this->status;
        $salarySchedule->created_by = auth()->user()->member->church_id;
        $salarySchedule->save();
        
        $salaryScheduleComponent = [];
        foreach ($this->scheduleElements as $key => $scheduleElement) {
            $salaryScheduleComponent[] = new SalaryScheduleComponent([
                'salary_schedule_id'         => $salarySchedule->id,
                'salary_schedule_element_id' => $scheduleElement['salary_schedule_element_id'],
                'amount'                     => $scheduleElement['amount'],
             ]);
        }

        $res = $salarySchedule->scheduleComponents()->saveMany($salaryScheduleComponent);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Salaray Schedule created']);
        redirect()->route('salaries-schedules.index');
    }

    public function render()
    {
        return view('livewire.accounting.salary-schedule.create-schedule');
    }
}
