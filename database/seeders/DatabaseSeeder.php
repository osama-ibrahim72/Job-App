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
        $mgr = \App\Models\User::factory()->create([
            'email' => 'manger@example.com',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'dial_code' => '20',
            'phone' => 123456789,
            'password' => Hash::make('Password!'),
            'remember_token' => Str::random(10),
            'blocked' => false,
        ]);

        $mgr->contexts()->syncWithoutDetaching(Context::whereIn('name', ['mgr'])->pluck('id')->toArray());
        $reg = \App\Models\User::factory()->create([
            'email' => 'regular@example.com',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'dial_code' => '20',
            'phone' => 12345678,
            'password' => Hash::make('Password!'),
            'remember_token' => Str::random(10),
            'blocked' => false,
        ]);

        $reg->contexts()->syncWithoutDetaching(Context::whereIn('name', ['regular'])->pluck('id')->toArray());
    }
}
