<?php

namespace Darius\User\Tests\Feature;

use Darius\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function bcrypt;
use function route;

class loginTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_by_email()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('!!Black1349'),
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '!!Black1349',
        ]);

        $this->assertAuthenticated();
   }

    public function test_user_can_login_by_mobile()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile' => '9395412354',
            'password' => bcrypt('!!Black1349'),
        ]);

        $this->post(route('login'), [
            'email' => $user->mobile,
            'password' => '!!Black1349',
        ]);

        $this->assertAuthenticated();
    }

}
