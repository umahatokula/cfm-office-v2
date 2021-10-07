<?php

use Illuminate\Database\Seeder;
use App\Month;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('months')->truncate();

		$jan = new Month;
		$jan->month = 'January';
		$jan->save();

		$feb = new Month;
		$feb->month = 'February';
		$feb->save();

		$mar = new Month;
		$mar->month = 'March';
		$mar->save();

		$apr = new Month;
		$apr->month = 'April';
		$apr->save();

		$may = new Month;
		$may->month = 'May';
		$may->save();

		$jun = new Month;
		$jun->month = 'June';
		$jun->save();

		$jul = new Month;
		$jul->month = 'July';
		$jul->save();

		$aug = new Month;
		$aug->month = 'August';
		$aug->save();

		$sep = new Month;
		$sep->month = 'September';
		$sep->save();

		$oct = new Month;
		$oct->month = 'October';
		$oct->save();

		$nov = new Month;
		$nov->month = 'November';
		$nov->save();

		$dec = new Month;
		$dec->month = 'December';
		$dec->save();
    }
}
