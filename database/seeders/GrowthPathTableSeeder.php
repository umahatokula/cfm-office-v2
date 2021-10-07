<?php

use Illuminate\Database\Seeder;
use App\GrowthPath;

class GrowthPathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('growth_paths')->truncate();

		$membership_class = new GrowthPath;
		$membership_class->name = "Membership Class";
		$membership_class->description = "Membership Class";
		$membership_class->church_id = 1;
		$membership_class->save();

		$bible_sch_1 = new GrowthPath;
		$bible_sch_1->name = "Bible School 1";
		$bible_sch_1->description = "Bible School 1";
		$bible_sch_1->church_id = 1;
		$bible_sch_1->save();

		$bible_sch_2 = new GrowthPath;
		$bible_sch_2->name = "Bible School 2";
		$bible_sch_2->description = "Bible School 2";
		$bible_sch_2->church_id = 1;
		$bible_sch_2->save();
    }
}
