<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Location::factory(4)->create();
        Location::create([
            'name' => 'عفرين',
        ]);
        Location::create([
            'name' => 'أعزاز',
        ]);
        Location::create([
            'name' => 'الباب',
        ]);
        Location::create([
            'name' => 'سرمدا',
        ]);
        Location::create([
            'name' => 'الدانا',
        ]);
    }
}
