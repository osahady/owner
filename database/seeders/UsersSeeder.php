<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->createOne([
            'name' => 'أسامة',
            'email' => 'osahady@gmail.com',
        ]);
        User::factory()->createOne([
            'name' => 'عبادة',
            'email' => 'abukarmo194@gmail.com',
        ]);
        User::factory()->createOne([
            'name' => 'أحمد',
            'email' => 'ahmad@gmail.com',
        ]);
        User::factory()->createOne([
            'name' => 'سالم',
            'email' => 'salem@gmail.com',
        ]);
        User::factory()->createOne([
            'name' => 'كريم',
            'email' => 'kareem@gmail.com',
        ]);
    }
}
