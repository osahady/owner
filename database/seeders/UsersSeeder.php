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
            'name' => 'Osama',
            'email' => 'osahady@gmail.com',
        ]);
        User::factory(4)->create();
    }
}
