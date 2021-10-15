<?php

namespace Database\Seeders;

use App\Models\FollowupTarget;
use Illuminate\Database\Seeder;

class FollowUpTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FollowupTarget::factory()->count(100)->create();
    }
}
