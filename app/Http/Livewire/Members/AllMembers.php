<?php

namespace App\Http\Livewire\Members;

use App\Models\Church;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class AllMembers extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $churchId;
 
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function filterByCenter($churchId) {
        // dd($churchId);
        $this->churchId = $churchId;
    }

    public function destroy($id) {
        Member::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Member successfully deleted']);

    }

    public function render()
    {
        if ($this->churchId) {
            $members = Member::where('church_id', $this->churchId)->where('slug', 'like', '%'.$this->search.'%')->paginate(20);
        } else {
            $members = Member::where('slug', 'like', '%'.$this->search.'%')->paginate(20);  
        }
        

        return view('livewire.members.all-members', [
            'members' => $members,
            'churches' => Church::all(),
        ]);
    }
}
