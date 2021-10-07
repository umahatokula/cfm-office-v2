<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\AgeGroup;

class AgeGroupTableSeeder extends Seeder {

public function run(){
	 	// DB::table('age_groups')->delete();
		DB::table('age_groups')->truncate();

		$age_group_1 = AgeGroup::create(array(
		            'age_group'         => '0 - 5'
		        ));

		$age_group_2 = AgeGroup::create(array(
		            'age_group'         => '6 - 10'
		        ));

		$age_group_3 = AgeGroup::create(array(
		            'age_group'         => '11 - 15'
		        ));

		$age_group_4 = AgeGroup::create(array(
		            'age_group'         => '16 - 20'
		        ));

		$age_group_5 = AgeGroup::create(array(
		            'age_group'         => '21 - 25'
		        ));

		$age_group_6 = AgeGroup::create(array(
		            'age_group'         => '26 - 30'
		        ));

		$age_group_7 = AgeGroup::create(array(
		            'age_group'         => '31 - 35'
		        ));

		$age_group_8 = AgeGroup::create(array(
		            'age_group'         => '36 - 40'
		        ));

		$age_group_9 = AgeGroup::create(array(
		            'age_group'         => '41 - Above'
		        ));
	}
	
}