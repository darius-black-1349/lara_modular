<?php

namespace Darius\User\Tests\Feature;

use Darius\Category\Models\Category;
use Darius\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Darius\RolePermissions\Models\Permission;
use Darius\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_permitted_user_can_see_categories_panel()
    {
        $this->actingAsAdmin();
        $this->get(route('categories.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_categories_panel()
    {
        $this->actingAsUser();
        $this->get(route('categories.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_categories()
    {
        $this->actingAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
    }

    public function test_permitted_user_can_update_categories()
    {
        $newTitle = 'alses';
        $newSlug = 'terrltrl';
        $this->actingAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), ['title' => $newTitle, 'slug' => $newSlug]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }

    public function test_user_can_delete_category()
    {
        $this->actingAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->delete(route('categories.destroy', 1))->assertOk();
    }

    private function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }

    private function actingAsUser()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
    }

    private function createCategory()
    {
        $this->post(route('categories.store'), ['title' => $this->faker->word, 'slug' => $this->faker->word]);
    }

}
