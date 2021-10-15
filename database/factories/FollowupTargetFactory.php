<?php

namespace Database\Factories;

use App\Models\FollowupTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowupTargetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FollowupTarget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'fname' => $this->faker->name(),
            'lname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'age_profile_id' => $this->faker->numberBetween(1,4),
            'status' => $this->faker->word(),
            'church_id' => $this->faker->numberBetween(1, 4),
            'assigned_by' => $this->faker->numberBetween(1,3),
        ];
    }
}
