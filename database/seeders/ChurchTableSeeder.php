<?php

use App\Models\Church;
use Illuminate\Database\Seeder;


class ChurchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('churches')->truncate();

      $gbk =  Church::create(array(
       'name'         => 'CFC Gboko',
       'address'      => 'Behind Gboko Hills, Ring Road, Gboko, Benue State',
       'phone'        => '08033333333',
       'email'        => 'cfc_gboko@christfamilyministries.org',
       'pastor'       => 1,
       'status_id'    => 1
       ));

      // $gbkPastor = new Pastor;
      // $gbkPastor->member_id = 3;
      // $gbkPastor->church_id = 1;
      // $gbkPastor->is_resident = 1;
      // $gbkPastor->save();

      // // create account type entries for this church
      // $tithes                   = new AccountType;
      // $tithes->church_id        = $gbk->id;
      // $tithes->account_type     = 'Tithes';
      // $tithes->percentage       = 10;
      // $tithes->save();
      
      // $welfare                  = new AccountType;
      // $welfare->church_id       = $gbk->id;
      // $welfare->account_type    = 'Welfare';
      // $welfare->percentage      = 25;
      // $welfare->save();
      
      // $savings                  = new AccountType;
      // $savings->church_id       = $gbk->id;
      // $savings->account_type    = 'Savings';
      // $savings->percentage      = 25;
      // $savings->save();
      
      // $operations               = new AccountType;
      // $operations->church_id    = $gbk->id;
      // $operations->account_type = 'Operations';
      // $operations->percentage   = 40;
      // $operations->save();


      $mkd = Church::create(array(
       'name'         => 'CFC Makurdi',
       'address'      => 'Behind Gboko Hills, Ring Road, Gboko, Benue State',
       'phone'        => '08033333333',
       'email'        => 'cfc_gboko@christfamilyministries.org',
       'pastor'       => 1,
       'status_id'    => 1
       ));

      // $mkdPastor = new Pastor;
      // $mkdPastor->member_id = 4;
      // $mkdPastor->church_id = 2;
      // $mkdPastor->is_resident = 1;
      // $mkdPastor->save();

      // // create account type entries for this church
      // $tithes                   = new AccountType;
      // $tithes->church_id        = $mkd->id;
      // $tithes->account_type     = 'Tithes';
      // $tithes->percentage       = 10;
      // $tithes->save();
      
      // $welfare                  = new AccountType;
      // $welfare->church_id       = $mkd->id;
      // $welfare->account_type    = 'Welfare';
      // $welfare->percentage      = 25;
      // $welfare->save();
      
      // $savings                  = new AccountType;
      // $savings->church_id       = $mkd->id;
      // $savings->account_type    = 'Savings';
      // $savings->percentage      = 25;
      // $savings->save();
      
      // $operations               = new AccountType;
      // $operations->church_id    = $mkd->id;
      // $operations->account_type = 'Operations';
      // $operations->percentage   = 40;
      // $operations->save();

      $kd = Church::create(array(
       'name'           => 'CFC Kaduna',
       'address'      => 'Behind Gboko Hills, Ring Road, Gboko, Benue State',
       'phone'          => '08033333333',
       'email'        => 'cfc_gboko@christfamilyministries.org',
       'pastor'       => 1,
       'status_id'      => 1
       ));

      // $kdPastor = new Pastor;
      // $kdPastor->member_id = 5;
      // $kdPastor->church_id = 3;
      // $kdPastor->is_resident = 1;
      // $kdPastor->save();

      // // create account type entries for this church
      // $tithes                   = new AccountType;
      // $tithes->church_id        = $kd->id;
      // $tithes->account_type     = 'Tithes';
      // $tithes->percentage       = 10;
      // $tithes->save();
      
      // $welfare                  = new AccountType;
      // $welfare->church_id       = $kd->id;
      // $welfare->account_type    = 'Welfare';
      // $welfare->percentage      = 25;
      // $welfare->save();
      
      // $savings                  = new AccountType;
      // $savings->church_id       = $kd->id;
      // $savings->account_type    = 'Savings';
      // $savings->percentage      = 25;
      // $savings->save();
      
      // $operations               = new AccountType;
      // $operations->church_id    = $kd->id;
      // $operations->account_type = 'Operations';
      // $operations->percentage   = 40;
      // $operations->save();

      $abj = Church::create(array(
       'name'     	=> 'CFC Abuja',
       'address'      => 'Behind Gboko Hills, Ring Road, Gboko, Benue State',
       'phone'    	=> '08033333333',
       'email'   	    => 'cfc_gboko@christfamilyministries.org',
       'pastor'	    => 1,
       'status_id'	=> 1
       ));

      // $abjPastor = new Pastor;
      // $abjPastor->member_id = 6;
      // $abjPastor->church_id = 4;
      // $abjPastor->is_resident = 1;
      // $abjPastor->save();

      // // create account type entries for this church
      // $tithes                   = new AccountType;
      // $tithes->church_id        = $abj->id;
      // $tithes->account_type     = 'Tithes';
      // $tithes->percentage       = 10;
      // $tithes->save();
      
      // $welfare                  = new AccountType;
      // $welfare->church_id       = $abj->id;
      // $welfare->account_type    = 'Welfare';
      // $welfare->percentage      = 25;
      // $welfare->save();
      
      // $savings                  = new AccountType;
      // $savings->church_id       = $abj->id;
      // $savings->account_type    = 'Savings';
      // $savings->percentage      = 25;
      // $savings->save();
      
      // $operations               = new AccountType;
      // $operations->church_id    = $abj->id;
      // $operations->account_type = 'Operations';
      // $operations->percentage   = 40;
      // $operations->save();

    }
  }
