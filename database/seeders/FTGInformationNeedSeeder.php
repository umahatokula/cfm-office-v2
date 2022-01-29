<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FTGInformationNeed;

class FTGInformationNeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FTGInformationNeed::truncate();
        
        $record1 = new FTGInformationNeed;
        $record1->name = 'Partnership';
        $record1->active = 1;
        $record1->save();

        $record2 = new FTGInformationNeed;
        $record2->name = 'Products';
        $record2->active = 1;
        $record2->save();

        $record3 = new FTGInformationNeed;
        $record3->name = 'Mission & Outreach';
        $record3->active = 1;
        $record3->save();

        $record4 = new FTGInformationNeed;
        $record4->name = 'Upcoming events/Programmes';
        $record4->active = 1;
        $record4->save();
    }
}
