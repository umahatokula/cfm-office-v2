<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\ChurchRole;

class ChurchRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('church_roles')->truncate();

		$pastor = new ChurchRole;
		$pastor->name = "Pastor";
		$pastor->description = "Pastor";
		$pastor->church_id = 1;
		$pastor->save();

		$deacon = new ChurchRole;
		$deacon->name = "Deacon";
		$deacon->description = "Deacon";
		$deacon->church_id = 1;
		$deacon->save();

		$cell_leader = new ChurchRole;
		$cell_leader->name = "Cell Leader";
		$cell_leader->description = "Cell Leader";
		$cell_leader->church_id = 1;
		$cell_leader->save();
    }
}
