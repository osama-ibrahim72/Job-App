<?php

namespace Database\Seeders;

use App\Models\Context;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ContextSeeder::class);
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'dial_code' => '20',
            'phone' => 123456789,
            'password' => Hash::make('Password!'),
            'remember_token' => Str::random(10),
            'blocked' => false,
        ]);

        $user->contexts()->syncWithoutDetaching(Context::whereIn('name', ['mgr', 'regular'])->pluck('id')->toArray());
    }
}
