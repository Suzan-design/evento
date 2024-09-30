<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MobileUserFactory extends Factory
{
    protected $model = MobileUserFactory::class ;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // default password
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'age' => $this->faker->numberBetween(18, 60),
            'phone_number' => $this->faker->phoneNumber,
            'state' => $this->faker->randomElement(['Aleppo','Al-Ḥasakah','Al-Qamishli','Al-Qunayṭirah'
                ,'Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','Latakia' , 'Rif Dimashq']),
            'birth_date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(),
            'is_complete' => $this->faker->boolean,
            'is_verified' => $this->faker->boolean,
            'type' => $this->faker->randomElement(['normal' , 'organizer']),
        ];
    }
}
