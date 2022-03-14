<?php

namespace App\Http\Livewire\Accounting\SalarySchedule;

use Livewire\Component;
use App\Models\SalarySchedule;
use App\Models\SalaryScheduleElement;
use App\Models\SalaryScheduleComponent;

class EditSchedule extends Component
{
    public $name, $status;
    public $scheduleElements = [];
    public $salaryScheduleElements;
    public SalarySchedule $salarySchedule;

    protected $rules=[
        'name'     => 'required',
    ];
    
    /**
     * mount
     *
     * @return void
     */
    public function mount(SalarySchedule $salarySchedule) {
        
        $this->name = $salarySchedule->name;
        $this->status = $salarySchedule->status;
        $this->salarySchedule = $salarySchedule;

        $this->scheduleElements = $salarySchedule->scheduleComponents->map(function($element) {
            return [
                'salary_schedule_element_id' => $element->salary_schedule_element_id,
                'percentage' => $element->percentage,
            ];
        });

        $this->salaryScheduleElements = SalaryScheduleElement::all();

    }
    
    /**
     * add requisition
     *
     * @return void
     */
    public function addScheduleElement() {
        $this->scheduleElements[] = [
            'salary_schedule_element_id' => null,
            'percentage' => null,
        ];
    }
    
    /**
     * remove requisition
     *
     * @param  mixed $index
     * @return void
     */
    public function removeScheduleElement($key) {
        if (!is_array($this->scheduleElements)) {
            $this->scheduleElements = $this->scheduleElements->toArray();
        }
        
        array_key_exists($key, $this->scheduleElements) ? array_splice($this->scheduleElements, $key, 1) : null;
    }

    public function getTotal() {
        if (!is_array($this->scheduleElements)) {
            $this->scheduleElements = $this->scheduleElements->toArray();
        }
        return array_sum(array_column($this->scheduleElements, 'percentage'));
    }

    public function save() {
        $this->validate();
        
        $total = $this->getTotal();
    
        $this->salarySchedule->name       = $this->name;
        $this->salarySchedule->status     = $this->status;
        $this->salarySchedule->created_by = auth()->user()->member->church_id;
        $this->salarySchedule->save();

        // delete existing schedule components
        $this->salarySchedule->scheduleComponents()->delete();
        
        $salaryScheduleComponent = [];
        foreach ($this->scheduleElements as $key => $scheduleElement) {
            $salaryScheduleComponent[] = new SalaryScheduleComponent([
                'salary_schedule_id'         => $this->salarySchedule->id,
                'salary_schedule_element_id' => $scheduleElement['salary_schedule_element_id'],
                'percentage'                 => $scheduleElement['percentage'],
             ]);
        }

        $res = $this->salarySchedule->scheduleComponents()->saveMany($salaryScheduleComponent);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Salaray Schedule created']);
        redirect()->route('salaries-schedules.index');
    }
    public function render()
    {
        return view('livewire.accounting.salary-schedule.edit-schedule');
    }
}
