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
            'phone' => '+905383648218'
        ]);
        User::factory()->createOne([
            'name' => 'عبادة',
            'phone' => '+352681526427'
        ]);
        User::factory()->createOne([
            'name' => 'أحمد',
            'phone' => '+905383648211'
        ]);
        User::factory()->createOne([
            'name' => 'سالم',
            'phone' => '+905383648212'
        ]);
        User::factory()->createOne([
            'name' => 'كريم',
            'phone' => '+352681537449'
        ]);
    }
}
