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
            'name' => 'regular_offering',
            'description' => 'Regular offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'connection_offering',
            'description' => 'Connection offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'tithes',
            'description' => 'Tithes',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'first_fruit',
            'description' => 'First Fruit offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'thanksgiving_offering',
            'description' => 'Thankgiving offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'special_offering',
            'description' => 'Special offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'project_offering',
            'description' => 'Project offering',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'pos',
            'description' => 'POS',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'honorarium',
            'description' => 'Honorarium',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);

        TransactionType::insert([
            'name' => 'requisition',
            'description' => 'Requisition',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "2110", "dr": "4103"}')),
        ]);
    }
}
