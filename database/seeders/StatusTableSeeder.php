<?php

namespace Database\Seeders;

use \App\Models\Status;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->truncate();

		Status::create(array(
		            'status'         => 'active',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'inactive',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'approved',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'unprocessed',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'declined',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'paid',
		            'description'    => 'transaction status'
		        ));

		Status::create(array(
		            'status'         => 'unpaid',
		            'description'    => 'transaction status'
		        ));

		Status::create(array(
		            'status'         => 'processed',
		            'description'    => 'for general use'
		        ));

		Status::create(array(
		            'status'         => 'up coming event',
		            'description'    => 'event status'
		        ));

		Status::create(array(
		            'status'         => 'on going event',
		            'description'    => 'event status'
		        ));

		Status::create(array(
		            'status'         => 'expired event',
		            'description'    => 'event status'
		        ));

		Status::create(array(
		            'status'         => 'new',
		            'description'    => 'follow up status'
		        ));

		Status::create(array(
		            'status'         => 'in progress',
		            'description'    => 'follow up status'
		        ));

		Status::create(array(
		            'status'         => 'complete',
		            'description'    => 'follow up status'
		        ));
    }
}
