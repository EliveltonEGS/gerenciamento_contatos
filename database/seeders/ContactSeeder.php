<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'name' => fake()->name(),
            'contact' => fake()->randomNumber(9, true),
            'email' => fake()->email()
        ]);
    }
}
