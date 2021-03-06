<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Media;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ad::withoutEvents(function () {

            Ad::factory(100)->create();
        });
    }
}
