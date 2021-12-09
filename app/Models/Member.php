<?php

namespace App\Models;

use App\FollowUp;
use Carbon\Carbon;
use App\Models\Cell;
use App\Models\User;
use App\Requisition;
use App\MemberFamily;
use App\Models\Local;
use App\Models\State;
use App\Models\Church;
use App\Models\Gender;
use App\Models\Region;
use App\Models\Country;
use App\Models\AgeProfile;
use App\Models\ServiceTeam;
use Spatie\Sluggable\HasSlug;
use App\Models\MemberServiceTeam;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Member extends Model implements HasMedia
{
    use InteractsWithMedia;

	use SearchableTrait;
    use HasSlug;
	use HasFactory;

	protected $searchable = [
		'columns' => [
			'members.unique_id' => 10,
			'members.fname' => 10,
			'members.lname' => 10,
			'members.phone' => 10,
			'members.email' => 10
        ],
	];

    protected $fillable = [
        'unique_id',
        'fname',
        'lname',
        'mname',
        'full_name',
        'gender_id',
        'email',
        'phone',
        'dob',
        'address',
        'local_id',
        'state_id',
        'country_id',
        'age_profile_id',
        'marital_id',
        'cell_id',
        'service_team_id',
        'occupation',
        'facebook',
        'whatsapp',
        'twitter',
        'instagram',
        'picture_path',
        'church_id',
        'region_id',
        'status_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['fname', 'lname'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


	public function generateUniqueId() {
    	// The length we want the unique reference number to be
		$unique_ref_length = 7;

		// A true/false variable that lets us know if we've found a unique reference number or not
		$unique_ref_found = false;

		// Define possible characters. Characters that may be confused such as the letter 'O' and the number zero aren't included
		$possible_chars = "1234567890";

		// Until we find a unique reference, keep generating new ones
		while (!$unique_ref_found) {

    		// Start with a blank reference number
			$unique_ref = "";

			// Set up a counter to keep track of how many characters have currently been added
			$i = 0;

    		// Add random characters from $possible_chars to $unique_ref until $unique_ref_length is reached
			while ($i < $unique_ref_length) {

        		// Pick a random character from the $possible_chars list
				$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);

				$unique_ref .= $char;

				$i++;

			}

    		// Our new unique reference number is generated. Lets check if it exists or not
			// $query = "SELECT `order_ref_no` FROM `orders`
			// WHERE `order_ref_no`='".$unique_ref."'";
			// $result = mysql_query($query) or die(mysql_error().' '.$query);
			$result = Member::where('unique_id', $unique_ref)->first();
			// dd($result);
			if (is_null($result)) {

        		// We've found a unique number. Lets set the $unique_ref_found variable to true and exit the while loop
				$unique_ref_found = true;

			}

			return $unique_ref;

		}
	}

	/**
	 * Accessor for Age.
	 */
	public function getAgeAttribute()
	{
		return Carbon::parse($this->attributes['dob'])->age + 1;
	}

    public function getUniqueIdAttribute($value) {
        return str_pad($value, 7, '0', STR_PAD_LEFT);
    }

    // Every user BELONGS TO (ie is) a person
	public function church(){
		return $this->belongsTo(Church::class)->withDefault();
	}

	public function gender(){
		return $this->belongsTo(Gender::class)->withDefault();
	}

	public function country(){
		return $this->belongsTo(Country::class)->withDefault();
	}

	public function state(){
		return $this->belongsTo(State::class)->withDefault();
	}

	public function local(){
		return $this->belongsTo(Local::class)->withDefault();
	}

	public function ageProfile(){
		return $this->belongsTo(AgeProfile::class)->withDefault();
	}

	public function cell(){
		return $this->belongsTo(Cell::class)->withDefault();
	}

	public function serviceTeam(){
		return $this->belongsTo(ServiceTeam::class)->withDefault();
	}

	public function memberFamily() {
		return $this->hasOne(MemberFamily::class)->withDefault();
	}

	public function followUp(){
		return $this->hasOne(FollowUp::class)->withDefault();
	}

	public function memberRegion(){
		return $this->belongsTo(Region::class, 'region_id', 'id', 'regions')->withDefault();
	}

	public function serviceTeams(){
		return $this->hasMany(MemberServiceTeam::class);
	}

	public function requisitions(){
		return $this->hasMany(Requisition::class)->withDefault();
	}

	public function user(){
		return $this->hasOne(User::class)->withDefault();
	}



    /**
     * add a member to a cell
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addTocell($cell_id) {
        $this->cell_id = $cell_id;
        $this->save();

        return $this;
    }
}
