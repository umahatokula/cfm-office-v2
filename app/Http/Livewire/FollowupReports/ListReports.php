<?php

namespace App\Http\Livewire\FollowupReports;

use Livewire\Component;
use App\Models\LifeCoach;
use App\Models\FollowUpReport;
use App\Models\FollowupTarget;

class ListReports extends Component
{    
    public FollowupTarget $target;
    public LifeCoach $lifeCoach;
    public $report_content;
    public $showReportForm = true;
    public $editReport = false;

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.followup-reports.list-reports');
    }
    
    /**
     * mount
     *
     * @param  mixed $target
     * @param  mixed $lifeCoach
     * @return void
     */
    public function mount(FollowupTarget $target, LifeCoach $lifeCoach) {
        $this->target = $target;
        $this->lifeCoach = $lifeCoach;
    }

    public function save() {
        // dd($this->report, $this->lifeCoach);

        $report = new FollowUpReport();
        $report->report = $this->report_content;
        $report->followup_target_id = $this->target->id;
        $report->life_coach_id = auth()->user()->id; #The coach id will be gotten from authenticated user id
        $report->save();

        redirect()->route('followup-reports.all-reports', $this->target);
    }

    public function editReport($report_id) {
        $report = FollowUpReport::find($report_id);

        $this->showReportForm = true;
        $this->editReport = true;
        $this->report_content = $report->report;
        // dd($this->report_content);

    }
}
