<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ReligionSeeder;
use Database\Seeders\BloodGroupSeeder;
use Database\Seeders\NationalitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        $this->call(BloodGroupSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
    }
}
