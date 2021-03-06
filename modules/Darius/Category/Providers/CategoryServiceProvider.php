<?php

namespace Darius\Category\Providers;

use Darius\Category\Database\Seeds\CategoryTableSeeder;
use Darius\Category\Models\Category;
use Darius\Category\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/categories_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Categories');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        \DatabaseSeeder::$seeders[] = CategoryTableSeeder::class;
        Gate::policy(Category::class, CategoryPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.categories', [
            "icon" => "i-categories",
            "title" => "دسته بندی ها",
            "url" => route('categories.index'),

        ]);
    }
}
