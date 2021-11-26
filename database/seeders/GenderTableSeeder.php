<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;


class GenderTableSeeder extends Seeder {

public function run(){
	 	// DB::table('gender')->delete();
	 	DB::table('gender')->truncate();

		$male = Gender::create(array(
			'name' => 'Male'
		));

		$female = Gender::create(array(
			'name' => 'Female'
		));
	}
	
}