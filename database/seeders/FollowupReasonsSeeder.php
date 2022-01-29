<?php

namespace Database\Seeders;

use App\Models\FollowupReason;
use Illuminate\Database\Seeder;

class FollowupReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        FollowupReason::truncate();
        
        $record1 = new FollowupReason;
        $record1->reason = 'New Convert';
        $record1->church_id = 1;
        $record1->save();
        
        $record1 = new FollowupReason;
        $record1->reason = 'First Time Guest';
        $record1->church_id = 1;
        $record1->save();
    }
}
