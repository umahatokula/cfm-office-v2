<?php

namespace Database\Seeders;

use App\Models\LifeCoach;
use Illuminate\Database\Seeder;

class LifeCoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LifeCoach::factory()->count(100)->create();
    }
}
