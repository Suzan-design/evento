<?php

namespace Database\Factories;

use App\Models\Event\EventsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventsCategoryFactory extends Factory
{
    protected $model = EventsCategory::class ;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'icon' => $this->faker->imageUrl(),
        ];
    }
}
