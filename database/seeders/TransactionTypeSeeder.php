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
            'name' => 'pay_staff_salary',
            'description' => 'Pay staff salary',
            'dr_cr_codes' => json_encode (json_decode ('{"cr": "210000", "dr": "121000"}')),
        ]);
    }
}
