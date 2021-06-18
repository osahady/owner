<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cities = [
            'الدانا',
            'أعزاز',
            'الباب',
            'عفرين',
        ];
        return [
            'name' => $this->faker->unique()->randomElement($cities),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
