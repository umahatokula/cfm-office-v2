<?php

namespace App\Http\Livewire\Members;

use App\Models\Member;
use Livewire\Component;

class ShowMember extends Component
{
    public Member $member;
        
    /**
     * mount
     *
     * @return void
     */
    public function mount(Member $member) {
        $this->member = $member;
    }


    public function render()
    {
        return view('livewire.members.show-member');
    }
}
