<?php

use Illuminate\Database\Seeder;
use App\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// DB::table('members')->truncate();

    	$faker = Faker\Factory::create();

    	$limit = 100;

    	for ($i = 0; $i < $limit; $i++) {

    		$member = new Member;
            $member->unique_id      = $member->generateUniqueId();
    		$member->fname         	= $faker->firstName;
    		$member->lname         	= $faker->lastName;
            $member->mname          = $faker->lastName;
    		$member->full_name      = $member->fname.' '.$member->mname.' '.$member->lname;
    		$member->email         	= $faker->email;
    		$member->phone         	= $faker->e164PhoneNumber;
    		$member->address      	= $faker->address;
    		$member->local_id     	= $faker->numberBetween($min = 1, $max = 500);
    		$member->state_id     	= $faker->numberBetween($min = 1, $max = 36);
            $member->country_id     = 273;
            $member->marital_id     = 1;
    		$member->gender_id    	= $faker->numberBetween($min = 1, $max = 2);
    		$member->age_profile_id = $faker->numberBetween($min = 1, $max = 3);
    		$member->dob         	= $faker->date($format = 'Y-m-d', $max = 'now');
    		$member->church_id    	= $faker->numberBetween($min = 1, $max = 3);
    		$member->save();
    	}
    }
}
