<?php

namespace Database\Seeders;

use App\Models\FTGInterest;
use Illuminate\Database\Seeder;

class FTGInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FTGInterest::truncate();
        
        $record1 = new FTGInterest;
        $record1->name = 'Receiving Jesus as my Savior';
        $record1->active = 1;
        $record1->save();

        $record2 = new FTGInterest;
        $record2->name = 'Joining Christ Family Center';
        $record2->active = 1;
        $record2->save();

        $record3 = new FTGInterest;
        $record3->name = 'Baptism';
        $record3->active = 1;
        $record3->save();

        $record4 = new FTGInterest;
        $record4->name = 'Discipleship';
        $record4->active = 1;
        $record4->save();

        $record5 = new FTGInterest;
        $record5->name = 'Growing Spiritually';
        $record5->active = 1;
        $record5->save();

        $record6 = new FTGInterest;
        $record6->name = 'Joining a TEAM';
        $record6->active = 1;
        $record6->save();
    }
}
