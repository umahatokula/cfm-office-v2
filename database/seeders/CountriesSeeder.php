<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Country;

class CountriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');
        //Empty the countries table
        DB::table('countries')->truncate();

        //Get all of the countries
        $countries = Countries::all();

        DB::table('countries')->insert([
                'name'        => 'Nigeria',
                'region'      => 'Africa',
                'subregion'   => '',
                'currency'    => 'Naira',
                'ISO4217Code' => 'NGN',
                'callingCode' => '+234',
                'timezone'    => '+1 GMT',
            ]);

        DB::table('countries')->insert([
                'name'        => 'Côte d’Ivoire',
                'region'      => 'Africa',
                'subregion'   => '',
                'currency'    => 'Franc',
                'ISO4217Code' => 'CFA',
                'callingCode' => '+225',
                'timezone'    => '-1 GMT',
            ]);

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name'        => $country->name->official ? $country->name->official : '',
                // 'region'      => $country->region ? $country->region : '',
                // 'subregion'   => $country->subregion ? $country->subregion : '',
                // 'currency'    => $country->currency[0]['title'] ? $country->currency[0]['title'] : '',
                // 'ISO4217Code' => $country->currency[0]['ISO4217Code'] ? $country->currency[0]['ISO4217Code'] : '',
                // 'callingCode' => $country->callingCode[0] ? $country->callingCode[0] : '',
                // 'timezone'    => $country->timezone ? $country->timezone : '',
            ]);
        }
    }
}
