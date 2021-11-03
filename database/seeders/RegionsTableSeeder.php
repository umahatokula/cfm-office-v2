<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();

        Region::create([
            'church_id' => 4,
            'name' => 'Wuse'
        ]);
        
        Region::create([
            'church_id' => 4,
            'name' => 'Apo'
        ]);
        
        Region::create([
            'church_id' => 4,
            'name' => 'Lugbe'
        ]);
        
        Region::create([
            'church_id' => 4,
            'name' => 'Kubwa'
        ]);
        
        Region::create([
            'church_id' => 4,
            'name' => 'Gwarimpa'
        ]);
        
        Region::create([
            'church_id' => 4,
            'name' => 'Mararaba'
        ]);
    }
}
