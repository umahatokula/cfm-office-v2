<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\ServiceType;

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
		            'service_type' 		=> 'Total Life Prosperity Service',
		            'status'         	=> 1
		        ));

		$mid_week_service = ServiceType::create(array(
		            'service_type' 		=> 'Connect To Life Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'service_type' 		=> 'Tiv Conect To Life Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'service_type' 		=> 'Believers\' Service',
		            'status'         	=> 1
		        ));

		$faith_adventure = ServiceType::create(array(
		            'service_type' 		=> 'Baptism Service',
		            'status'         	=> 1
		        ));

		$special_service = ServiceType::create(array(
		            'service_type' 		=> 'Special Service',
		            'status'         	=> 1
		        ));
    }
}
