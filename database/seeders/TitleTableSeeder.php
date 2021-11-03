<?php

namespace Database\Seeders;

use DB;
use App\Models\Title;
use Illuminate\Database\Seeder;

class TitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titles')->truncate();

		Title::create(array(
		            'name'         => 'Mr.'
		        ));

		Title::create(array(
		            'name'         => 'Mrs.'
		        ));

		Title::create(array(
		            'name'         => 'Miss.'
		        ));

		Title::create(array(
		            'name'         => 'Rev.'
		        ));

		Title::create(array(
		            'name'         => 'Pastor'
		        ));

		Title::create(array(
		            'name'         => 'Apostle'
		        ));

		Title::create(array(
		            'name'         => 'Evang.'
		        ));

		Title::create(array(
		            'name'         => 'Prophet'
		        ));

		Title::create(array(
		            'name'         => 'Prophetess'
		        ));
    }
}
