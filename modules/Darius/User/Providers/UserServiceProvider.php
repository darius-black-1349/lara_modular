<?php

namespace Darius\User\Providers;

use Darius\User\Database\Seeds\UserTableSeeder;
use Darius\User\Http\Middleware\StoreUserIp;
use Darius\User\Models\User;
use Darius\User\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        \DatabaseSeeder::$seeders[] = UserTableSeeder::class;
        Gate::policy(User::class, UserPolicy::class);
    }

    public function boot()
    {
        config()->set('auth.providers.users.model', User::class);
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "title" => "کاربران",
            "url" => route('users.index'),

        ]);
    }
}
