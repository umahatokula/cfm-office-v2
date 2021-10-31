<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Cell;

class CellsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cells')->truncate();

		$young_and_alive = new Cell;
		$young_and_alive->name = "Young and Alive";
		$young_and_alive->description = "Young and Alive";
		$young_and_alive->church_id = 1;
		$young_and_alive->save();

		$the_core = new Cell;
		$the_core->name = "The Core";
		$the_core->description = "The Core";
		$the_core->church_id = 1;
		$the_core->save();

		$the_bridge = new Cell;
		$the_bridge->name = "The Bridge";
		$the_bridge->description = "The Bridge";
		$the_bridge->church_id = 1;
		$the_bridge->save();

		$the_rock = new Cell;
		$the_rock->name = "The Rock";
		$the_rock->description = "The Rock";
		$the_rock->church_id = 1;
		$the_rock->save();

		$light_house = new Cell;
		$light_house->name = "Light House";
		$light_house->description = "Light House";
		$light_house->church_id = 1;
		$light_house->save();

		$cornerstone = new Cell;
		$cornerstone->name = "Cornerstone";
		$cornerstone->description = "Cornerstone";
		$cornerstone->church_id = 1;
		$cornerstone->save();

		$gloryland = new Cell;
		$gloryland->name = "Gloryland";
		$gloryland->description = "Gloryland";
		$gloryland->church_id = 1;
		$gloryland->save();
    }
}
