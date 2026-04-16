<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $starts = fake()->dateTimeBetween('-1 month', '+3 months');

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(2, true),
            'starts_at' => $starts,
            'ends_at' => (clone $starts)->modify('+'.fake()->numberBetween(1, 8).' hours'),
            'venue' => fake()->company().' Hall',
            'capacity' => fake()->numberBetween(50, 500),
        ];
    }
}
