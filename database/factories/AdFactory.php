<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $locations = Location::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        return [

            'title' => $this->faker->word(),
            'body' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(10, 1000),
            'user_id' => $this->faker->randomElement($users),
            'location_id' => $this->faker->randomElement($locations),
            'category_id' => $this->faker->randomElement($categories),
            'created_at' => $this->faker->dateTimeBetween('-2 months'),


        ];
    }
}
