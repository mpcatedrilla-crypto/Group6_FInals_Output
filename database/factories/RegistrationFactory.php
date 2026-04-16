<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'participant_id' => Participant::factory(),
            'status' => fake()->randomElement(['confirmed', 'waitlist', 'cancelled']),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
