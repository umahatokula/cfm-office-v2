<?php

namespace Database\Seeders;

use App\Models\AgeProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;


class AgeGroupTableSeeder extends Seeder {

public function run(){
	 	// DB::table('age_groups')->delete();
		DB::table('age_groups')->truncate();

		$age_group_1 = AgeProfile::create(array(
			'name' => '1 - 5',
			'lower_bound' => '1',
			'upper_bound' => '5',
			'church_id' => rand(1, 6)
		));

		$age_group_2 = AgeProfile::create(array(
			'name' => '6 - 10',
			'lower_bound' => '6',
			'upper_bound' => '10',
			'church_id' => rand(1, 6)
		));

		$age_group_3 = AgeProfile::create(array(
			'name' => '11 - 15',
			'lower_bound' => '11',
			'upper_bound' => '15',
			'church_id' => rand(1, 6)
		));

		$age_group_4 = AgeProfile::create(array(
			'name' => '16 - 20',
			'lower_bound' => '16',
			'upper_bound' => '20',
			'church_id' => rand(1, 6)
		));

		$age_group_5 = AgeProfile::create(array(
			'name' => '21 - 25',
			'lower_bound' => '21',
			'upper_bound' => '25',
			'church_id' => rand(1, 6)
		));

		$age_group_6 = AgeProfile::create(array(
			'name' => '26 - 30',
			'lower_bound' => '26',
			'upper_bound' => '30',
			'church_id' => rand(1, 6)
		));

		$age_group_7 = AgeProfile::create(array(
			'name' => '31 - 35',
			'lower_bound' => '31',
			'upper_bound' => '35',
			'church_id' => rand(1, 6)
		));

		$age_group_8 = AgeProfile::create(array(
			'name' => '36 - 40',
			'lower_bound' => '36',
			'upper_bound' => '40',
			'church_id' => rand(1, 6)
		));

		$age_group_9 = AgeProfile::create(array(
			'name' => '41 - Above',
			'lower_bound' => '41',
			'upper_bound' => '50',
			'church_id' => rand(1, 6)
		));
	}
	
}