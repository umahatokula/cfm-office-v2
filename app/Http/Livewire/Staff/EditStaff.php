<?php

namespace App\Http\Livewire\Staff;

use Carbon\Carbon;
use App\Models\Local;
use App\Models\Staff;
use App\Models\State;
use App\Models\Church;
use App\Models\Gender;
use App\Models\Country;
use Livewire\Component;
use App\Models\MaritalStatus;
use Livewire\WithFileUploads;

class EditStaff extends Component
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

    // ========= STAFF =========
    public Staff $staff;
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

    public function mount(Staff $staff)
    {
        $staff = $staff;

        $this->genders       = Gender::all();
        $this->states        = State::all();
        $this->states        = State::all();
        $this->locals        = Local::orderBy('name', 'asc')->get();
        $this->countries     = Country::orderBy('name', 'asc')->get();
        $this->churches      = Church::get();
        $this->maritalStatus = MaritalStatus::get();

        //=======================STAFF======================
        $this->fname             = $staff->fname;
        $this->lname             = $staff->lname;
        $this->phone             = $staff->phone;
        $this->email             = $staff->email;
        $this->dob               = $staff->dob;
        $this->gender_id         = $staff->gender_id;
        $this->marital_status_id = $staff->marital_status_id;
        $this->country_id        = $staff->country_id;
        $this->state_id          = $staff->state_id;
        $this->local_id          = $staff->local_id;
        $this->day               = $staff->day;
        $this->month             = $staff->month;
        $this->year              = $staff->year;
        $this->church_id         = $staff->church_id;
        $this->address           = $staff->address;
        $this->picture           = $staff->picture;
        $this->facebook          = $staff->facebook;
        $this->whatsapp          = $staff->whatsapp;
        $this->twitter           = $staff->twitter;
        $this->instagram         = $staff->instagram;

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
        $this->staff->fname      = $this->fname;
        $this->staff->lname      = $this->lname;
        $this->staff->phone      = $this->phone;
        $this->staff->email      = $this->email;
        $this->staff->dob        = $this->dob;
        $this->staff->church_id  = $this->church_id;
        $this->staff->gender_id  = $this->gender_id;
        $this->staff->country_id = $this->country_id;
        $this->staff->state_id   = $this->state_id;
        $this->staff->local_id   = $this->local_id;
        $this->staff->address    = $this->address;
        $this->staff->facebook   = $this->facebook;
        $this->staff->whatsapp   = $this->whatsapp;
        $this->staff->twitter    = $this->twitter;
        $this->staff->instagram  = $this->instagram;
        $this->staff->save();

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
        return view('livewire.staff.edit-staff');
    }
}
