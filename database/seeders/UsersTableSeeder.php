<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $arome->mname          = 'Isaac';
        $arome->full_name      = $arome->fname.' '.$arome->mname.' '.$arome->lname;
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

        //create new staff. This member is the initial seed member who will create other member on the system
        $go = User::create([
          'name'      => $arome->full_name,
          'email'     => $arome->email,
          'password'  => \Hash::make('come'),
          'member_id' => $arome->id
          ]);

        $go->attachRole($general_overseer);



        $avese = new Member;
        $avese->unique_id      = $avese->generateUniqueId();
        $avese->fname          = 'Avese';
        $avese->lname          = 'Tokula';
        $avese->mname          = 'Jennifer';
        $avese->full_name      = $avese->fname.' '.$avese->mname.' '.$avese->lname;
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

        //create new staff. This member is the initial seed member who will create other member on the system
        $avese_res = User::create([
          'name'      => $avese->full_name,
          'email'     => $avese->email,
          'password'  => \Hash::make('come'),
          'member_id' => $avese->id
          ]);

        $avese_res->attachRole($coordinatorchurches);



        $bem = new Member;
        $bem->unique_id      = $bem->generateUniqueId();
        $bem->fname          = 'Bem';
        $bem->lname          = 'Ichull';
        $bem->mname          = 'Daniel';
        $bem->full_name      = $bem->fname.' '.$bem->mname.' '.$bem->lname;
        $bem->email          = 'bemichull@christfamilyministries.org';
        $bem->phone          = '08033312448';
        $bem->address        = 'No 8, Gboko Road, USA';
        $bem->local_id       = 56;
        $bem->state_id       = 11;
        $bem->region_id      = 1;
        $bem->country_id     = 273;
        $bem->gender_id      = 1;
        $bem->marital_id     = 1;
        $bem->age_profile_id = 1;
        $bem->dob            = '1978-01-04';
        $bem->church_id      = 1;
        $bem->save();

        //create new staff. This member is the initial seed member who will create other member on the system
        $bem_res = User::create([
          'name'      => $bem->full_name,
          'email'     => $bem->email,
          'password'  => \Hash::make('come'),
          'member_id' => $bem->id
          ]);

        $bem_res->attachRole($residentpastor);





        $atom = new Member;
        $atom->unique_id      = $atom->generateUniqueId();
        $atom->fname          = 'Atom';
        $atom->lname          = 'Ahura';
        $atom->mname          = 'Stephen';
        $atom->full_name      = $atom->fname.' '.$atom->mname.' '.$atom->lname;
        $atom->email          = 'atomahura@christfamilyministries.org';
        $atom->phone          = '08033312448';
        $atom->address        = 'No 8, Gboko Road, USA';
        $atom->local_id       = 56;
        $atom->state_id       = 11;
        $atom->region_id      = 1;
        $atom->country_id     = 273;
        $atom->gender_id      = 1;
        $atom->marital_id     = 1;
        $atom->age_profile_id = 1;
        $atom->dob            = '1978-01-04';
        $atom->church_id      = 2;
        $atom->save();

        //create new staff. This member is the initial seed member who will create other member on the system
        $atom_res = User::create([
          'name'      => $atom->full_name,
          'email'     => $atom->email,
          'password'  => \Hash::make('come'),
          'member_id' => $atom->id
          ]);

        $atom_res->attachRole($residentpastor);





        $seyi = new Member;
        $seyi->unique_id      = $seyi->generateUniqueId();
        $seyi->fname          = 'Seyi';
        $seyi->lname          = 'Kolawole';
        $seyi->mname          = '';
        $seyi->full_name      = $seyi->fname.' '.$seyi->mname.' '.$seyi->lname;
        $seyi->email          = 'seyikola@christfamilyministries.org';
        $seyi->phone          = '08033312448';
        $seyi->address        = 'No 8, Gboko Road, USA';
        $seyi->local_id       = 56;
        $seyi->state_id       = 11;
        $seyi->region_id      = 1;
        $seyi->country_id     = 273;
        $seyi->gender_id      = 1;
        $seyi->marital_id     = 1;
        $seyi->age_profile_id = 1;
        $seyi->dob            = '1978-01-04';
        $seyi->church_id      = 3;
        $seyi->save();

        //create new staff. This member is the initial seed member who will create other member on the system
        $seyi_res = User::create([
          'name'      => $seyi->full_name,
          'email'     => $seyi->email,
          'password'  => \Hash::make('come'),
          'member_id' => $seyi->id
          ]);

        $seyi_res->attachRole($residentpastor);





        $deo = new Member;
        $deo->unique_id      = $deo->generateUniqueId();
        $deo->fname          = 'Deo';
        $deo->lname          = 'Ode';
        $deo->mname          = 'Godwin';
        $deo->full_name      = $deo->fname.' '.$deo->mname.' '.$deo->lname;
        $deo->email          = 'deoode@christfamilyministries.org';
        $deo->phone          = '08033312448';
        $deo->address        = 'No 8, Gboko Road, USA';
        $deo->local_id       = 56;
        $deo->state_id       = 11;
        $deo->region_id      = 1;
        $deo->country_id     = 273;
        $deo->gender_id      = 1;
        $deo->marital_id     = 1;
        $deo->age_profile_id = 1;
        $deo->dob            = '1978-01-04';
        $deo->church_id      = 4;
        $deo->save();

        //create new staff. This member is the initial seed member who will create other member on the system
        $deo_res = User::create([
          'name'      => $deo->full_name,
          'email'     => $deo->email,
          'password'  => \Hash::make('come'),
          'member_id' => $deo->id
          ]);

        $deo_res->attachRole($residentpastor);





        $ovalsoftUser = User::create([
            'name'     => 'Ovalsoft',
            'email'    => 'dev@ovalsofttechnologies.com',
            'password' => bcrypt('gravitation30.'),
            ]);

        $ovalsoftUser->attachRole($general_overseer);

        foreach ($permissions as $permission) {

            $go->attachPermission($permission);
            $ovalsoftUser->attachPermission($permission);

        }
    }
}
