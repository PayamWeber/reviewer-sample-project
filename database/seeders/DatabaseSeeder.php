<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'admin@admin.com',
             'password' => Hash::make("password"),
         ]);

         Provider::query()->create([
             'title' => 'Provider Number One'
         ]);

         Provider::query()->create([
             'title' => 'Provider Number Two'
         ]);
    }
}
