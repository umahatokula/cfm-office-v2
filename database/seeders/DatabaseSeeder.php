<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\CountriesSeeder;
use Database\Seeders\CellsTableSeeder;
use Database\Seeders\LocalTableSeeder;
use Database\Seeders\StateTableSeeder;
use Database\Seeders\TitleTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ChurchTableSeeder;
use Database\Seeders\GenderTableSeeder;
use Database\Seeders\RegionsTableSeeder;
use Database\Seeders\AgeGroupTableSeeder;
use Database\Seeders\FollowUpTargetSeeder;
use Database\Seeders\ServiceTeamsTableSeeder;
use Database\Seeders\ServiceTypesTableSeeder;
use Database\Seeders\MaritalStatusTableSeeder;
use Database\Seeders\RolesAndPermissionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Member::factory(500)->create();

        $this->call([
            // MemberSeeder::class,
            // FollowUpTargetSeeder::class,
            RolesAndPermissionsTableSeeder::class,
            UsersTableSeeder::class,
            ChurchTableSeeder::class,
            StateTableSeeder::class,
            CountriesSeeder::class,
            GenderTableSeeder::class,
            LocalTableSeeder::class,
            AgeGroupTableSeeder::class,
            ServiceTeamsTableSeeder::class,
            MaritalStatusTableSeeder::class,
            TitleTableSeeder::class,
            CellsTableSeeder::class,
            ServiceTypesTableSeeder::class,
            RegionsTableSeeder::class,
        ]);
    }
}
