<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionTypeDoubleEntry;

class TransactionTypeDoubleEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionTypeDoubleEntry::truncate();

        TransactionTypeDoubleEntry::insert([
            'transaction_type_code' => 'cr',
            'name' => 'Credit',
        ]);

        TransactionTypeDoubleEntry::insert([
            'transaction_type_code' => 'dr',
            'name' => 'Dedit',
        ]);
    }
}
