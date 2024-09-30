<?php

namespace Database\Factories;

use App\Models\Event\EventsCategory;
use App\Models\User\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrganizerFactory extends Factory
{
    protected $model = Organizer::class ;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mobile_user_id' => \App\Models\User\MobileUser::factory(),
            'category_id' => EventsCategory::factory(),
            'name' => $this->faker->name,
            'bio' => $this->faker->text,
            'services' => $this->faker->sentence,
            'state' => $this->faker->state,
            'images' => $this->faker->imageUrl(),
        ];
    }
}
