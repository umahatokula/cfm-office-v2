<?php

namespace App\Http\Livewire\Members;

use Carbon\Carbon;
use App\Models\Cell;
use App\Models\Local;
use App\Models\State;
use App\Models\Church;
use App\Models\Gender;
use App\Models\Member;
use App\Models\Region;
use App\Models\Country;
use Livewire\Component;
use App\Models\AgeProfile;
use App\Models\ServiceTeam;
use Livewire\WithFileUploads;

class EditMember extends Component
{
    use WithFileUploads;
    
    public $genders;
    public $states;
    public $ageProfiles;
    public $locals;
    public $countries;
    public $churches;
    public $cells;
    public $serviceTeams;
    public $regions;
    public $days;
    public $months;

    // ========= MEMBER =========
    public $fname;
    public $lname;
    public $mname;
    public $gender_id;
    public $email;
    public $phone;
    public $occupation;
    public $country_id;
    public $state_id;
    public $local_id;
    public $day;
    public $month;
    public $year;
    public $age_profile_id;
    public $church_id;
    public $address;
    public $region_id;
    public $picture;
    public $cell_id;
    public $facebook;
    public $whatsapp;
    public $twitter;
    public $instagram;

    public Member $member;

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'email',
    ];

    public function mount(Member $member) {
        $this->member = $member;

        $this->fname          = $member->fname;
        $this->lname          = $member->lname;
        $this->mname          = $member->mname;
        $this->gender_id      = $member->gender_id;
        $this->email          = $member->email;
        $this->phone          = $member->phone;
        $this->occupation     = $member->occupation;
        $this->country_id     = $member->country_id;
        $this->state_id       = $member->state_id;
        $this->local_id       = $member->local_id;
        $this->day            = $member->day;
        $this->month          = $member->month;
        $this->year           = $member->year;
        $this->age_profile_id = $member->age_profile_id;
        $this->church_id      = $member->church_id;
        $this->address        = $member->address;
        $this->region_id      = $member->region_id;
        $this->picture        = $member->picture;
        $this->cell_id        = $member->cell_id;
        $this->facebook       = $member->facebook;
        $this->whatsapp       = $member->whatsapp;
        $this->twitter        = $member->twitter;
        $this->instagram      = $member->instagram;
        
        $this->genders      = Gender::all();
        $this->states       = State::all();
        $this->ageProfiles  = AgeProfile::all();
        $this->states       = State::all();
        $this->locals       = Local::orderBy('name', 'asc')->get();
        $this->countries    = Country::orderBy('name', 'asc')->get();
        $this->churches     = Church::get();
        $this->cells        = Cell::where('church_id', auth()->user()->member->church_id)->get();
        $this->serviceTeams = ServiceTeam::where('church_id', auth()->user()->member->church_id)->get();
        $this->regions      = Region::where('church_id', auth()->user()->member->church_id)->get();

        $days = [];
        for ($i=1; $i <= 31; $i++) { 
            $days[] = $i;
        }
        $this->days = $days ;

        $months = [];
        for ($i=1; $i <= 12; $i++) { 
            $months[] = $i;
        }
        $this->months = $months ;
    }

    public function save() {

        $this->validate();
        
        if ($this->day || $this->month || $this->year) {
            
            if ($this->day) {
                $day = $this->day;
            }
            
            if ($this->month) {
                $month = $this->month;
            }
            
            if ($this->year) {
                $year = $this->year;
            }
            $dob = $month.'/'.$day.'/'.$year;
            $dob = Carbon::parse($dob);
        }

        $this->member->unique_id      = $this->member->generateUniqueId(); 
        $this->member->fname          = $this->fname;
        $this->member->lname          = $this->lname;
        $this->member->mname          = $this->mname;
        $this->member->gender_id      = $this->gender_id;
        $this->member->email          = $this->email;
        $this->member->phone          = $this->phone;
        $this->member->occupation     = $this->occupation;
        $this->member->country_id     = $this->country_id;
        $this->member->state_id       = $this->state_id;
        $this->member->local_id       = $this->local_id;
        $this->member->dob            = $dob ?? null;
        $this->member->age_profile_id = $this->age_profile_id;
        $this->member->church_id      = $this->church_id;
        $this->member->address        = $this->address;
        $this->member->region_id      = $this->region_id;
        $this->member->cell_id        = $this->cell_id;
        $this->member->facebook       = $this->facebook;
        $this->member->whatsapp       = $this->whatsapp;
        $this->member->twitter        = $this->twitter;
        $this->member->instagram      = $this->instagram;
        $this->member->save();

        if ($this->picture) {
            $member
                ->addMedia($this->picture->getRealPath())
                ->usingName($this->picture->getClientOriginalName())
                ->toMediaCollection('member', 'public');
        }
        
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Member successfully updated']);

        redirect()->route('members.index');
    }

    public function render()
    {
        return view('livewire.members.edit-member');
    }
}
