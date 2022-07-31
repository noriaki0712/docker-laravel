<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'title'=> $this->faker->randomElement(["おはよう","こんにちわ","こんばんわ"]),
        'detail' => $this->faker->randomElement(["おはよう"*6,"こんにちわ"*6,"こんばんわ"*6]),
        'created_at' =>now(),
        'updated_at'=>now()
        ];
    }
}
