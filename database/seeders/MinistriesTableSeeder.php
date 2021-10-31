<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Ministry;

class MinistriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ministries')->truncate();

		$campus = new Ministry;
		$campus->leader = 1;
		$campus->name = "Campus";
		$campus->description = "Campus";
		$campus->church_id = 1;
		$campus->save();

		$worship = new Ministry;
		$worship->leader = 1;
		$worship->name = "worship";
		$worship->description = "worship";
		$worship->church_id = 1;
		$worship->save();

		$youth = new Ministry;
		$youth->leader = 1;
		$youth->name = "Youth";
		$youth->description = "Youth";
		$youth->church_id = 1;
		$youth->save();
    }
}
