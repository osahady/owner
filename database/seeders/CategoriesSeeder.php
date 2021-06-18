<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::factory(4)->create();
        Category::create(['name' => 'عقارات']);
        Category::create(['name' => 'سيارات']);
        Category::create(['name' => 'حواسيب وجوالات']);
        Category::create(['name' => 'أدوات منزلية']);
        Category::create(['name' => 'دروس خصوصي']);
    }
}
