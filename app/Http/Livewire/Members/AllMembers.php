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
 
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.members.all-members', [
            'members' => Member::where('slug', 'like', '%'.$this->search.'%')->paginate(10),
            'churches' => Church::all(),
        ]);
    }
}
