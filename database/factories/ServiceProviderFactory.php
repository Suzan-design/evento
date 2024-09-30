<?php

namespace Database\Factories;

use App\Models\ServiceProvider\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    protected $model = ServiceProvider::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User\MobileUser::factory(),
            'category_id' => \App\Models\ServiceProvider\ServicesCategory::factory(),
            'location_work_governorate' => $this->faker->randomElement(['Aleppo','Al-Ḥasakah','Al-Qamishli','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','Latakia' , 'Rif Dimashq']), // list all governorates
            'address' => $this->faker->address,
            'start_work' => $this->faker->time(),
            'end_work' => $this->faker->time(),
            'images' => json_encode([$this->faker->imageUrl()]), // assuming array of images in JSON
            'videos' => json_encode([$this->faker->url]), // assuming array of videos in JSON
        ];
    }
}
