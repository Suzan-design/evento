<?php

namespace Database\Factories;

use App\Models\Common\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InterestFactory extends Factory
{
    protected $model = Amenity::class ;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => $this->faker->imageUrl(),
            'title' => $this->faker->word
        ];
    }
}
