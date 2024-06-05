<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->email,
            'tell' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'detail' => $this->faker->text(10),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
