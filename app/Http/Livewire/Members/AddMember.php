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

class AddMember extends Component
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

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'email',
    ];

    public function mount()
    {
        $this->genders = Gender::all();
        $this->states = State::all();
        $this->ageProfiles    = AgeProfile::all();
        $this->states         = State::all();
        $this->locals         = Local::orderBy('name', 'asc')->get();
        $this->countries      = Country::orderBy('name', 'asc')->get();
        $this->churches       = Church::get();
        $this->cells          = Cell::where('church_id', auth()->user()->member->church_id)->get();
        $this->serviceTeams   = ServiceTeam::where('church_id', auth()->user()->member->church_id)->get();
        $this->regions        = Region::where('church_id', auth()->user()->member->church_id)->get();

        
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

        $member = new Member;
        $member->unique_id      = $member->generateUniqueId(); 
        $member->fname          = $this->fname;
        $member->lname          = $this->lname;
        $member->mname          = $this->mname;
        $member->gender_id      = $this->gender_id;
        $member->email          = $this->email;
        $member->phone          = $this->phone;
        $member->occupation     = $this->occupation;
        $member->country_id     = $this->country_id;
        $member->state_id       = $this->state_id;
        $member->local_id       = $this->local_id;
        $member->dob            = $dob;
        $member->age_profile_id = $this->age_profile_id;
        $member->church_id      = $this->church_id;
        $member->address        = $this->address;
        $member->region_id      = $this->region_id;
        $member->cell_id        = $this->cell_id;
        $member->facebook       = $this->facebook;
        $member->whatsapp       = $this->whatsapp;
        $member->twitter        = $this->twitter;
        $member->instagram      = $this->instagram;
        $member->save();

        if ($this->picture) {
            $member
                ->addMedia($this->picture->getRealPath())
                ->usingName($this->picture->getClientOriginalName())
                ->toMediaCollection('member', 'public');
        }
        
        session()->flash('message', 'Member successfully added.');

        redirect()->route('members.index');
    }

    public function render()
    {
        return view('livewire.members.add-member');
    }

}
