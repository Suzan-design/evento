<?php

namespace Database\Factories;

use App\Models\Venue\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    protected $model = Venue::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'capacity' => $this->faker->numberBetween(50, 500),
            'governorate' => $this->faker->randomElement(['Aleppo', 'Damascus', 'Homs', 'Latakia', ...]), // add more as needed
            'location_description' => $this->faker->text,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'contact_number' => $this->faker->phoneNumber,
            'images' => json_encode([$this->faker->imageUrl()]), // assuming array of images in JSON
            'videos' => json_encode([$this->faker->url]), // assuming array of videos in JSON
        ];
    }
}
