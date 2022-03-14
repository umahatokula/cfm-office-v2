<?php

namespace App\Http\Livewire\Staff;

use App\Models\Staff;
use App\Models\Church;
use Livewire\Component;
use Livewire\WithPagination;

class AllStaff extends Component
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
        Staff::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Staff successfully deleted']);

    }
    
    public function render()
    {
        if ($this->churchId) {
            $staff = Staff::where('church_id', $this->churchId)->where('slug', 'like', '%'.$this->search.'%')->paginate(50);
        } else {
            $staff = Staff::where('slug', 'like', '%'.$this->search.'%')->paginate(50);  
        }

        return view('livewire.staff.all-staff', [
            'staffs' => $staff,
            'churches' => Church::all(),
        ]);
    }
}
