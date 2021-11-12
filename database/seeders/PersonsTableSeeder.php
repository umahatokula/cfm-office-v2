<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Person;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// DB::table('persons')->truncate();

    	$faker = Faker\Factory::create();

    	$limit = 100;

    	for ($i = 0; $i < $limit; $i++) {

    		$person = new Person;
    		$person->fname         	= $faker->firstName;
    		$person->lname         	= $faker->lastName;
    		$person->mname         	= $faker->lastName;
    		$person->email         	= $faker->email;
    		$person->phone         	= $faker->e164PhoneNumber;
    		$person->address      	= $faker->address;
    		$person->local_id     	= $faker->numberBetween($min = 1, $max = 500);
    		$person->state_id     	= $faker->numberBetween($min = 1, $max = 36);
    		$person->country_id   	= 273;
    		$person->gender_id    	= $faker->numberBetween($min = 1, $max = 2);
    		$person->age_group_id 	= $faker->numberBetween($min = 1, $max = 6);
    		$person->dob         	= $faker->date($format = 'Y-m-d', $max = 'now');
    		$person->member_id   	= $faker->numberBetween($min = 1, $max = 100);
    		$person->church_id    	= $faker->numberBetween($min = 1, $max = 3);
    		$person->is_pastor      = $faker->numberBetween($min = 1, $max = 6);
    		$person->save();
    	}
    }
}
