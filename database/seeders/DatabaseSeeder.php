<?php

namespace Database\Seeders;

use App\Models\FollowupTarget;
use App\Models\LifeCoach;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use MembersTableSeeder;

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
        $this->call([
            // MemberSeeder::class,
            // LifeCoach::class,
            FollowUpTargetSeeder::class,
        ]);
    }
}
