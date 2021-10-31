<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\FollowUpTargetSeeder;
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
        ]);
    }
}
