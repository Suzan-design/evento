<?php

namespace Database\Seeders;

use App\Models\Event\EventsCategory;
use App\Models\User\MobileUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileUser::factory()->count(10)->create()->each(function ($user) {
            $user->eventCategories()->attach(
                EventsCategory::factory()->create()->id
            );
        });

    }
}
