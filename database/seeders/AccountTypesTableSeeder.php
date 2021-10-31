<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\AccountType;

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
		$tithes->account_type     = 'Tithes';
		$tithes->percentage       = 10;
		$tithes->save();
		
		$welfare                  = new AccountType;
		$welfare->church_id        = 1;
		$welfare->account_type    = 'Welfare';
		$welfare->percentage       = 25;
		$welfare->save();
		
		$savings                  = new AccountType;
		$savings->church_id        = 1;
		$savings->account_type    = 'Savings';
		$savings->percentage       = 25;
		$savings->save();
		
		$operations               = new AccountType;
		$operations->church_id        = 1;
		$operations->account_type = 'Operations';
		$operations->percentage       = 40;
		$operations->save();
    }
}
