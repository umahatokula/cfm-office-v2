<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        
        $arome = new Member;
        $arome->unique_id      = $arome->generateUniqueId();
        $arome->fname          = 'Arome';
        $arome->lname          = 'Tokula';
        $arome->mname          = 'Imadu';
        $arome->email          = 'arometokula@christfamilyministries.org';
        $arome->phone          = '08033312448';
        $arome->address        = 'No 8, Gboko Road, USA';
        $arome->local_id       = 56;
        $arome->state_id       = 11;
        $arome->region_id      = 1;
        $arome->country_id     = 273;
        $arome->gender_id      = 1;
        $arome->marital_id     = 1;
        $arome->age_profile_id = 1;
        $arome->dob            = '1978-01-04';
        $arome->church_id      = 4;
        $arome->save();

        $aromeUser = User::create([
          'name'      => $arome->fname.' '.$arome->lname,
          'email'     => $arome->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $arome->id
          ]);

        $aromeUser->assignRole('generaloverseer');



        $avese = new Member;
        $avese->unique_id      = $avese->generateUniqueId();
        $avese->fname          = 'Avese';
        $avese->lname          = 'Tokula';
        $avese->mname          = 'Jennifer';
        $avese->email          = 'avesetokula@christfamilyministries.org';
        $avese->phone          = '08033312448';
        $avese->address        = 'No 8, Gboko Road, USA';
        $avese->local_id       = 56;
        $avese->state_id       = 11;
        $avese->region_id      = 1;
        $avese->country_id     = 273;
        $avese->gender_id      = 1;
        $avese->marital_id     = 1;
        $avese->age_profile_id = 1;
        $avese->dob            = '1978-01-04';
        $avese->church_id      = 1;
        $avese->save();

        $aveseUser = User::create([
          'name'      => $avese->fname.' '.$avese->lname,
          'email'     => $avese->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $avese->id
          ]);

        $aveseUser->assignRole('coordinatorchurches');



        $gboko = new Member;
        $gboko->unique_id      = $gboko->generateUniqueId();
        $gboko->fname          = 'Bem';
        $gboko->lname          = 'Ichull';
        $gboko->mname          = 'Daniel';
        $gboko->email          = 'bemichull@christfamilyministries.org';
        $gboko->phone          = '08033312448';
        $gboko->address        = 'No 8, Gboko Road, USA';
        $gboko->local_id       = 56;
        $gboko->state_id       = 11;
        $gboko->region_id      = 1;
        $gboko->country_id     = 273;
        $gboko->gender_id      = 1;
        $gboko->marital_id     = 1;
        $gboko->age_profile_id = 1;
        $gboko->dob            = '1978-01-04';
        $gboko->church_id      = 1;
        $gboko->save();

        $gbokoUser = User::create([
          'name'      => $gboko->fname.' '.$gboko->lname,
          'email'     => $gboko->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $gboko->id
          ]);

        $gbokoUser->assignRole('residentpastor');


        $makurdi = new Member;
        $makurdi->unique_id      = $makurdi->generateUniqueId();
        $makurdi->fname          = 'Atom';
        $makurdi->lname          = 'Ahura';
        $makurdi->mname          = 'Stephen';
        $makurdi->email          = 'atomahura@christfamilyministries.org';
        $makurdi->phone          = '08033312448';
        $makurdi->address        = 'No 8, Gboko Road, USA';
        $makurdi->local_id       = 56;
        $makurdi->state_id       = 11;
        $makurdi->region_id      = 1;
        $makurdi->country_id     = 273;
        $makurdi->gender_id      = 1;
        $makurdi->marital_id     = 1;
        $makurdi->age_profile_id = 1;
        $makurdi->dob            = '1978-01-04';
        $makurdi->church_id      = 2;
        $makurdi->save();

        $makurdiUser = User::create([
          'name'      => $makurdi->fname.' '.$makurdi->lname,
          'email'     => $makurdi->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $makurdi->id
          ]);

        $makurdiUser->assignRole('residentpastor');





        $kd = new Member;
        $kd->unique_id      = $kd->generateUniqueId();
        $kd->fname          = 'Seyi';
        $kd->lname          = 'Kolawole';
        $kd->mname          = '';
        $kd->email          = 'seyikola@christfamilyministries.org';
        $kd->phone          = '08033312448';
        $kd->address        = 'No 8, Gboko Road, USA';
        $kd->local_id       = 56;
        $kd->state_id       = 11;
        $kd->region_id      = 1;
        $kd->country_id     = 273;
        $kd->gender_id      = 1;
        $kd->marital_id     = 1;
        $kd->age_profile_id = 1;
        $kd->dob            = '1978-01-04';
        $kd->church_id      = 3;
        $kd->save();

        $kdUser = User::create([
          'name'      => $kd->fname.' '.$kd->lname,
          'email'     => $kd->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $kd->id
          ]);

        $kdUser->assignRole('residentpastor');


        $abuja = new Member;
        $abuja->unique_id      = $abuja->generateUniqueId();
        $abuja->fname          = 'Deo';
        $abuja->lname          = 'Ode';
        $abuja->mname          = 'Godwin';
        $abuja->email          = 'deoode@christfamilyministries.org';
        $abuja->phone          = '08033312448';
        $abuja->address        = 'No 8, Gboko Road, USA';
        $abuja->local_id       = 56;
        $abuja->state_id       = 11;
        $abuja->region_id      = 1;
        $abuja->country_id     = 273;
        $abuja->gender_id      = 1;
        $abuja->marital_id     = 1;
        $abuja->age_profile_id = 1;
        $abuja->dob            = '1978-01-04';
        $abuja->church_id      = 4;
        $abuja->save();

        $abujaUser = User::create([
          'name'      => $abuja->fname.' '.$abuja->lname,
          'email'     => $abuja->email,
          'password'  => \Hash::make('87654321'),
          'member_id' => $abuja->id
          ]);

        $abujaUser->assignRole('residentpastor');


        $koachTechUser = User::create([
          'name'     => 'Koach Tech',
          'email'    => 'dev@koachtech.com',
          'password' => bcrypt('gravitation30.'),
        ]);
        $koachTechUser->assignRole('generaloverseer');

    }
}
