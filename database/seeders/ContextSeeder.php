<?php

namespace Database\Seeders;

use App\Models\Context;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contexts = [
            [
                'name' => 'mgr',
            ],
            [
                'name' => 'regular',
            ]
        ];

        collect($contexts)->each(fn($context) => Context::query()->firstOrCreate(['name' => $context['name']],$context));
    }
}
