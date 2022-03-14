<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FTGInvitationMode;

class FTGInvitationModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FTGInvitationMode::truncate();
        
        $record1 = new FTGInvitationMode;
        $record1->name = 'Receiving Jesus as my Savior';
        $record1->active = 1;
        $record1->save();

        $record2 = new FTGInvitationMode;
        $record2->name = 'Joining Christ Family Center';
        $record2->active = 1;
        $record2->save();

        $record3 = new FTGInvitationMode;
        $record3->name = 'Baptism';
        $record3->active = 1;
        $record3->save();

        $record4 = new FTGInvitationMode;
        $record4->name = 'Discipleship';
        $record4->active = 1;
        $record4->save();

        $record5 = new FTGInvitationMode;
        $record5->name = 'Growing Spiritually';
        $record5->active = 1;
        $record5->save();

        $record6 = new FTGInvitationMode;
        $record6->name = 'Joining a TEAM';
        $record6->active = 1;
        $record6->save();
    }
}
