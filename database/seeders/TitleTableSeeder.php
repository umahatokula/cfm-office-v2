<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Title;

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
		            'title'         => 'Mr.'
		        ));

		Title::create(array(
		            'title'         => 'Mrs.'
		        ));

		Title::create(array(
		            'title'         => 'Miss.'
		        ));

		Title::create(array(
		            'title'         => 'Rev.'
		        ));

		Title::create(array(
		            'title'         => 'Pastor'
		        ));

		Title::create(array(
		            'title'         => 'Apostle'
		        ));

		Title::create(array(
		            'title'         => 'Evang.'
		        ));

		Title::create(array(
		            'title'         => 'Prophet'
		        ));

		Title::create(array(
		            'title'         => 'Prophetess'
		        ));
    }
}
