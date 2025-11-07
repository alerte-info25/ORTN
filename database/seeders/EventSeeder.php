<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $user = User::first() ?? User::factory()->create();

        for ($i = 0; $i < 100; $i++) {
            $start = $faker->dateTimeBetween('-1 month', '+2 months');
            $end = (clone $start)->modify('+'.rand(1, 3).' days');

            $accessType = $faker->randomElement(['free', 'paid']);
            $price = $accessType === 'paid' ? $faker->randomFloat(2, 5, 100) : null;

            Event::create([
                'user_id' => $user->id,
                'title' => ucfirst($faker->words(rand(3, 6), true)),
                'description' => $faker->paragraphs(rand(3, 6), true),
                'category' => $faker->randomElement(['Conférence', 'Atelier', 'Webinar', 'Festival', 'Compétition']),

                'start_date' => $start->format('Y-m-d'),
                'start_time' => $start->format('H:i:s'),
                'end_date' => $end->format('Y-m-d'),
                'end_time' => $end->format('H:i:s'),

                'format' => $faker->randomElement(['online', 'hybride', null]),
                'venue' => $faker->company(),
                'address' => $faker->address(),
                'city' => $faker->city(),
                'online_url' => $faker->optional()->url(),

                'organizer' => $faker->name(),
                'organizer_email' => $faker->optional()->email(),
                'organizer_phone' => $faker->optional()->phoneNumber(),

                'image' => 'events/UTLB5xu26InFQ4YLWTWZIkbCWFW6hQ6Lvd9EhOab.jpg',

                'capacity' => $faker->numberBetween(10, 500),
                'access_type' => $accessType,
                'price' => $price,
                'requires_registration' => $faker->boolean(),
                'registration_url' => $faker->optional()->url(),

                'slug' => Str::slug($faker->unique()->sentence(3)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
