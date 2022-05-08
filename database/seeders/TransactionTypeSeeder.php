<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::truncate();

        TransactionType::insert([
            'name' => 'offering',
            'description' => 'Service offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);
    }
}
