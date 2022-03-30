<?php

namespace Darius\Category\Database\Seeds;

use Darius\Category\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'برنامه نویسی',
            'slug' => 'programming'
        ]);
    }
}
