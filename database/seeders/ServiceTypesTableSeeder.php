<?php

namespace Database\Seeders;

use DB;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->truncate();

		$power_worship_service = ServiceType::create(array(
		            'name' 		=> 'Total Life Prosperity Service',
		            'status'         	=> 1
		        ));

		$mid_week_service = ServiceType::create(array(
		            'name' 		=> 'Connect To Life Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'name' 		=> 'Tiv Conect To Life Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'name' 		=> 'Believers\' Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'name' 		=> 'Baptism Service',
		            'status'         	=> 1
		        ));

		$special_service = ServiceType::create(array(
		            'name' 		=> 'Special Service',
		            'status'         	=> 1
		        ));
    }
}
