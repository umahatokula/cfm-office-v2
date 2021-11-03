<?php

namespace Database\Seeders;

use DB;
use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_status')->truncate();

		$single = new MaritalStatus;
		$single->name = "Single";
		$single->save();

		$married = new MaritalStatus;
		$married->name = "Married";
		$married->save();

		$divorced = new MaritalStatus;
		$divorced->name = "Divorced";
		$divorced->save();

		$seperated = new MaritalStatus;
		$seperated->name = "Seperated";
		$seperated->save();

		$widowed = new MaritalStatus;
		$widowed->name = "Widowed";
		$widowed->save();

		$others = new MaritalStatus;
		$others->name = "Others";
		$others->save();
    }
}
