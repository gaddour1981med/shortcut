<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url' => fake()->url(),
            'shortcut' => Str::random(6),
            'user_id' => function() {
                 return User::factory()->create()->id;
            },
            'created_at'=>strtotime('now'),         
        ];
    }
}
