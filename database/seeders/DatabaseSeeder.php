<?php

namespace Database\Seeders;

use App\Models\Contacts;
use App\Models\Tags;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Tags::factory(50)->create();
        Contacts::factory(50)->create();
        Contacts::factory(50)->create()->each(function ($contact) {
            $tags = Tags::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $contact->tags()->attach($tags);
        });
    }
}
