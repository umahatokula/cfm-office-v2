<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	 	// DB::table('states')->delete();
	 	DB::table('states')->truncate();

		State::insert(['name' => 'Abia State']);
        State::insert(['name' => 'Adamawa State']);
        State::insert(['name' => 'Akwa Ibom State']);
        State::insert(['name' => 'Anambra State']);
        State::insert(['name' => 'Bauchi State']);
        State::insert(['name' => 'Bayelsa State']);
        State::insert(['name' => 'Benue State']);
        State::insert(['name' => 'Borno State']);
        State::insert(['name' => 'Cross River State']);
        State::insert(['name' => 'Delta State']);
        State::insert(['name' => 'Ebonyi State']);
        State::insert(['name' => 'Edo State']);
        State::insert(['name' => 'Ekiti State']);
        State::insert(['name' => 'Enugu State']);
        State::insert(['name' => 'FCT']);
        State::insert(['name' => 'Gombe State']);
        State::insert(['name' => 'Imo State']);
        State::insert(['name' => 'Jigawa State']);
        State::insert(['name' => 'Kaduna State']);
        State::insert(['name' => 'Kano State']);
        State::insert(['name' => 'Katsina State']);
        State::insert(['name' => 'Kebbi State']);
        State::insert(['name' => 'Kogi State']);
        State::insert(['name' => 'Kwara State']);
        State::insert(['name' => 'Lagos State']);
        State::insert(['name' => 'Nasarawa State']);
        State::insert(['name' => 'Niger State']);
        State::insert(['name' => 'Ogun State']);
        State::insert(['name' => 'Ondo State']);
        State::insert(['name' => 'Osun State']);
        State::insert(['name' => 'Oyo State']);
        State::insert(['name' => 'Plateau State']);
        State::insert(['name' => 'Rivers State']);
        State::insert(['name' => 'Sokoto State']);
        State::insert(['name' => 'Taraba State']);
        State::insert(['name' => 'Yobe State']);
        State::insert(['name' => 'Zamfara State']);
	}
}
