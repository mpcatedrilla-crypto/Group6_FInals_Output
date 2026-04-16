<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'group6@ccc.edu.ph'],
            [
                'name' => 'Group 6 API User',
                'password' => Hash::make('group6-password'),
            ]
        );

        Event::factory()->count(25)->create();
        Participant::factory()->count(50)->create();

        $eventIds = Event::query()->pluck('id');
        $participantIds = Participant::query()->pluck('id');

        $seen = [];
        $batch = [];
        $now = now();

        while (count($batch) < 1000) {
            $eventId = $eventIds->random();
            $participantId = $participantIds->random();
            $key = $eventId.'-'.$participantId;
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $batch[] = [
                'event_id' => $eventId,
                'participant_id' => $participantId,
                'status' => fake()->randomElement(['confirmed', 'waitlist', 'cancelled']),
                'notes' => fake()->optional(0.2)->sentence(),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($batch, 250) as $chunk) {
            Registration::query()->insert($chunk);
        }
    }
}
