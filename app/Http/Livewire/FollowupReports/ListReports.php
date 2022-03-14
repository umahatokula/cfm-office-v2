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
    public $pastor_report_content, $report_content, $report_id, $reportIdForPastorComment;
    public $showCoachReportForm = true;
    public $showPastorReportForm = false;
    public $editReport = false;
    public $reports;

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
        $this->reports = $target->reports;
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save() {

        $this->validate([
            'report_content' => 'required',
        ]);

        if ($this->editReport) {
            $report = FollowUpReport::find($this->report_id);
        } else {
            $report = new FollowUpReport();
        }
        
        $report->report = $this->report_content;
        $report->followup_target_id = $this->target->id;
        $report->life_coach_id = auth()->user()->id; #The coach id will be gotten from authenticated user id
        $report->save();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Report saved.']);
        redirect()->route('followup-reports.all-reports', $this->target);
    }
    
    /**
     * editReport
     *
     * @param  mixed $report_id
     * @return void
     */
    public function editReport($report_id) {
        $this->report_id = $report_id;
        $report = FollowUpReport::find($this->report_id);

        $this->showCoachReportForm = true;
        $this->editReport = true;
        $this->showPastorReportForm = false;
        $this->report_content = $report->report;

    }
        
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id) {
        FollowUpReport::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Report deleted.']);
        redirect()->route('followup-reports.all-reports', $this->target);
    }
    
    /**
     * onClickPastorReportForm
     *
     * @return void
     */
    public function onClickPastorReportForm() {
        $this->showPastorReportForm = !$this->showPastorReportForm;
        $this->showCoachReportForm = !$this->showCoachReportForm;
    }
    
    /**
     * onClickCoachReportForm
     *
     * @return void
     */
    public function onClickCoachReportForm() {
        $this->showPastorReportForm = false;
        $this->showCoachReportForm = !$this->showCoachReportForm;
    }
    
    /**
     * onSelectReport
     *
     * @return void
     */
    public function onSelectReport($report_id) {
        
        $report = FollowUpReport::find($report_id);
        $this->pastor_report_content = $report->pastors_comment;
    }
    
    /**
     * savePastorComment
     *
     * @return void
     */
    public function savePastorComment() {

        $report = FollowUpReport::find($this->reportIdForPastorComment);
        
        $report->pastors_comment = $this->pastor_report_content;
        $report->pastor_id = auth()->user()->id; #The coach id will be gotten from authenticated user id
        $report->save();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Report saved.']);
        redirect()->route('followup-reports.all-reports', $this->target);
        
    }
}
