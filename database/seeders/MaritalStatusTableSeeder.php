<?php

use Illuminate\Database\Seeder;
use App\MaritalStatus;

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
		$single->marital_status = "Single";
		$single->save();

		$married = new MaritalStatus;
		$married->marital_status = "Married";
		$married->save();

		$divorced = new MaritalStatus;
		$divorced->marital_status = "Divorced";
		$divorced->save();

		$seperated = new MaritalStatus;
		$seperated->marital_status = "Seperated";
		$seperated->save();

		$widowed = new MaritalStatus;
		$widowed->marital_status = "Widowed";
		$widowed->save();

		$others = new MaritalStatus;
		$others->marital_status = "Others";
		$others->save();
    }
}
