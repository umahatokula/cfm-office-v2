<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalaryScheduleElement;

class SalaryScheduleElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalaryScheduleElement::truncate();

        SalaryScheduleElement::create([
            'name' => 'Basic',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Dearness',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'House Rent',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Conveyance',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Leave Trave',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Medical',
            'increase_net_salary' => 1,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Pension',
            'increase_net_salary' => 0,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'Tax',
            'increase_net_salary' => 0,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'NHF',
            'increase_net_salary' => 0,
            'status' => 1
        ]);

        SalaryScheduleElement::create([
            'name' => 'PAYE',
            'increase_net_salary' => 0,
            'status' => 1
        ]);
    }
}
