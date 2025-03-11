<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'content' => $this->faker->unique()->word(), // これを使ってユニークなデータを強制的に生成
        ];
    }
}
