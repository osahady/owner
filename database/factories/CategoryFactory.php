<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cats = [
            'عقارات',
            'دروس خصوصي',
            'أجهزة كهربائية',
            'أدوات منزلية',
            'صيدليات',
        ];
        return [
            'name' => $this->faker->unique()->randomElement($cats),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),

        ];
    }
}
