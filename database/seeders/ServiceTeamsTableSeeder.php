<?php

namespace Database\Seeders;

use DB;
use App\Models\ServiceTeam;
use Illuminate\Database\Seeder;

class ServiceTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_teams')->truncate();

		$prayer = new ServiceTeam;
		$prayer->leader = 1;
		$prayer->name = "Prayer";
		$prayer->description = "Prayer Service team";
		$prayer->church_id = 1;
		$prayer->save();

		$art_and_media = new ServiceTeam;
		$art_and_media->leader = 1;
		$art_and_media->name = "Arts and Media";
		$art_and_media->description = "Arts and Media";
		$art_and_media->church_id = 1;
		$art_and_media->save();

		$ushering = new ServiceTeam;
		$ushering->leader = 1;
		$ushering->name = "Ushering";
		$ushering->description = "Ushering";
		$ushering->church_id = 1;
		$ushering->save();

		$protocol = new ServiceTeam;
		$protocol->leader = 1;
		$protocol->name = "Protocol";
		$protocol->description = "Protocol";
		$protocol->church_id = 1;
		$protocol->save();

		$welfare = new ServiceTeam;
		$welfare->leader = 1;
		$welfare->name = "Welfare";
		$welfare->description = "Welfare";
		$welfare->church_id = 1;
		$welfare->save();

		$sanitary = new ServiceTeam;
		$sanitary->leader = 1;
		$sanitary->name = "Sanitary";
		$sanitary->description = "Sanitary";
		$sanitary->church_id = 1;
		$sanitary->save();

		$counseling = new ServiceTeam;
		$counseling->leader = 1;
		$counseling->name = "Counseling";
		$counseling->description = "Counseling";
		$counseling->church_id = 1;
		$counseling->save();

		$concepts_and_aesthetics = new ServiceTeam;
		$concepts_and_aesthetics->leader = 1;
		$concepts_and_aesthetics->name = "Concepts and Aesthetics";
		$concepts_and_aesthetics->description = "Concepts and Aesthetics";
		$concepts_and_aesthetics->church_id = 1;
		$concepts_and_aesthetics->save();
    }
}
