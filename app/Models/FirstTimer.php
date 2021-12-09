<?php

namespace App\Models;

use App\Status;
use App\Models\Title;
use App\Models\AgeProfile;
use App\Models\FirstTimer;
use App\Models\ServiceType;
use App\Models\MaritalStatus;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FirstTimer extends Model
{

	use SearchableTrait;

	protected $searchable = [
		'columns' => [
		'first_timers.name' => 10,
		'first_timers.guest_of' => 10,
		'first_timers.phone_home' => 10,
		'first_timers.phone_office' => 10
		],
        'joins' => [
            'members' => ['members.id','first_timers.member_id'],
        ],
	];

	protected $dates = ['service_date'];

	public function ageProfile(){
		return $this->belongsTo(AgeProfile::class);
	}


	public function maritalStatus(){
		return $this->belongsTo(MaritalStatus::class);
	}


	public function title(){
		return $this->belongsTo(Title::class);
	}


	public function serviceType(){
		return $this->belongsTo(ServiceType::class);
	}


	public function status(){
		return $this->belongsTo(Status::class);
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
			$result = FirstTimer::where('unique_id', $unique_ref)->first();
			// dd($result);
			if (is_null($result)) { 

        		// We've found a unique number. Lets set the $unique_ref_found variable to true and exit the while loop  
				$unique_ref_found = true;  

			}

			return $unique_ref;

		}  
	}
}
