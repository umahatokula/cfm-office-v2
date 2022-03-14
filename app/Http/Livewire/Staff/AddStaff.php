<?php

namespace App\Http\Livewire\Staff;

use Carbon\Carbon;
use App\Models\Local;
use App\Models\Staff;
use App\Models\State;
use App\Models\Church;
use App\Models\Gender;
use App\Models\Member;
use App\Models\Country;
use Livewire\Component;
use App\Models\MaritalStatus;
use Livewire\WithFileUploads;

class AddStaff extends Component
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
    public $phone;
    public $email;
    public $dob;
    public $gender_id;
    public $marital_status_id;
    public $country_id;
    public $state_id;
    public $local_id;
    public $day;
    public $month;
    public $year;
    public $church_id;
    public $address;
    public $picture;
    public $facebook;
    public $whatsapp;
    public $twitter;
    public $instagram;

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'email',
        'church_id' => 'required',
    ];

    protected $messages = [
        'fname.required' => 'First name is required',
        'lname.required' => 'Last name is required',
        'email.email' => 'Enter a valid email address',
        'church_id.required' => 'Church is required',
    ];

    public function mount()
    {
        $this->genders       = Gender::all();
        $this->states        = State::all();
        $this->states        = State::all();
        $this->locals        = Local::orderBy('name', 'asc')->get();
        $this->countries     = Country::orderBy('name', 'asc')->get();
        $this->churches      = Church::get();
        $this->maritalStatus = MaritalStatus::get();

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

        $staff = new Staff;
        $staff->fname      = $this->fname;
        $staff->lname      = $this->lname;
        $staff->phone      = $this->phone;
        $staff->email      = $this->email;
        $staff->dob        = $this->dob;
        $staff->church_id  = $this->church_id;
        $staff->gender_id  = $this->gender_id;
        $staff->country_id = $this->country_id;
        $staff->state_id   = $this->state_id;
        $staff->local_id   = $this->local_id;
        $staff->address    = $this->address;
        $staff->facebook   = $this->facebook;
        $staff->whatsapp   = $this->whatsapp;
        $staff->twitter    = $this->twitter;
        $staff->instagram  = $this->instagram;
        $staff->save();

        if ($this->picture) {
            $staff
                ->addMedia($this->picture->getRealPath())
                ->usingName($this->picture->getClientOriginalName())
                ->toMediaCollection('staff', 'public');
        }
        
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Staff successfully added']);

        redirect()->route('staff.index');
    }
    
    public function render()
    {
        return view('livewire.staff.add-staff');
    }
}
