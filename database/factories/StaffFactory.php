<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gross = [500000, 350000, 200000, 120000, 80000, 50000];
        
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'church_id' => rand(1, 6),
            'gross_salary' => $gross[rand(0, 5)],
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
