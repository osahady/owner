<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $adIds = Ad::pluck('id')->toArray(); // 'created_at' => 'id'


        return [
            'ad_id' => $this->faker->randomElement($adIds),
            'path' => 'path/to/media',
        ];
    }
}
