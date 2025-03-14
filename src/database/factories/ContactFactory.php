<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
public function definition()
{
return [
'category_id' => $this->faker->numberBetween(1, 5),
'user_id' => User::factory(),
'first_name' => $this->faker->firstName(),
'last_name' => $this->faker->lastName(),
'gender' => $this->faker->randomElement([1, 2, 3]),
'email' => $this->faker->safeEmail(),
'tel' => $this->faker->phoneNumber(),
'address' => $this->faker->address(),
'detail' => $this->faker->text(120),
];
}
}