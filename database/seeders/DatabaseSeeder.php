<?php

namespace Database\Seeders;

use App\Models\DemoRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::query()->updateOrCreate(
            ['email' => 'group6@ccc.edu.ph'],
            [
                'name' => 'Group 6 API User',
                'password' => Hash::make('group6-password'),
            ]
        );

        DemoRecord::query()->where('user_id', $user->id)->delete();

        $now = now();
        $batch = [];
        for ($i = 1; $i <= 1000; $i++) {
            $batch[] = [
                'user_id' => $user->id,
                'label' => 'Demo row '.$i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($batch, 250) as $chunk) {
            DemoRecord::query()->insert($chunk);
        }
    }
}
