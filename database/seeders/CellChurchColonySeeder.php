<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CellChurchColony;

class CellChurchColonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CellChurchColony::truncate();

        CellChurchColony::create([
            'name' => 'Gwarinpa',
            'leader' => 'Saanyol Achiatar',
            'venue' => 'The Learned Company',
            'church_id' =>  3,
        ]);

        CellChurchColony::create([
            'name' => 'WOMOC',
            'leader' => 'Deo Ode',
            'venue' => 'Silverbird',
            'church_id' =>  3,
        ]);

        CellChurchColony::create([
            'name' => 'Karu',
            'leader' => 'John Owoicho',
            'venue' => 'In the wild',
            'church_id' =>  3,
        ]);
    }
}
