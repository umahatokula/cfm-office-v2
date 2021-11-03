<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\AccountType;
use DB;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->truncate();

		$tithes                   = new AccountType;
		$tithes->church_id        = 1;
		$tithes->name     = 'Tithes';
		$tithes->percentage       = 10;
		$tithes->save();
		
		$welfare                  = new AccountType;
		$welfare->church_id        = 1;
		$welfare->name    = 'Welfare';
		$welfare->percentage       = 25;
		$welfare->save();
		
		$savings                  = new AccountType;
		$savings->church_id        = 1;
		$savings->name    = 'Savings';
		$savings->percentage       = 25;
		$savings->save();
		
		$operations               = new AccountType;
		$operations->church_id        = 1;
		$operations->name = 'Operations';
		$operations->percentage       = 40;
		$operations->save();
    }
}
