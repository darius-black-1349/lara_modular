<?php

namespace Darius\RolePermissions\Providers;

use Darius\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Darius\RolePermissions\Models\Permission;
use Darius\RolePermissions\Models\Role;
use Darius\RolePermissions\Policies\RolePermissionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class RolePermissionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/role_permissions_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermissions');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        \DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
        Gate::policy(Role::class, RolePermissionPolicy::class);

        Gate::before(function ($user){
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.role-permissions', [
            "icon" => "i-role-permissions",
            "title" => "نقش های کاربری",
            "url" => route('role-permissions.index'),

        ]);
    }
}
