<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin')
        ]);

        \App\Models\Item::factory()->create([
            'name' => 'Pepsi',
            'price' => 45,
            'stock' => 5
        ]);

        \App\Models\Item::factory()->create([
            'name' => 'Cocacola',
            'price' => 48,
            'stock' => 5
        ]);

        \App\Models\Item::factory()->create([
            'name' => 'Television',
            'price' => 48000,
            'stock' => 52
        ]);
    }
}
