<?php

namespace Darius\User\Tests\Feature;

use Darius\User\Models\User;
use Darius\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function auth;
use function route;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_register_form()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();

        $this->registerNewUser();

        $this->assertCount(1, User::all());

    }

    public function test_user_have_to_verify_account()
    {
        $this->registerNewUser();

        $res = $this->get(route('home'));

        $res->assertRedirect(route('verification.notice'));


    }

    public function test_user_can_verify_account()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('!!Black1349'),
        ]);

        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code, now()->addDay());
        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();
        $this->post(route('verification.verify'),[
            'verify_code' => $code
        ]);

        $this->assertEquals(true, $user->fresh()->hasVerifiedEmail());
    }

    public function test_verified_user_can_see_home_page()
    {
        $this->registerNewUser();

        $this->assertAuthenticated();

        auth()->user()->markEmailAsVerified();

        $res = $this->get(route('home'));

        $res->assertOk();
    }

    /**
     * @return void
     */
    public function registerNewUser(): void
    {
        $this->post(route('register'), [
            'name' => 'alex',
            'email' => 'alex@gmail.com',
            'mobile' => '9158786956',
            'password' => '!!Black1349',
            'password_confirmation' => '!!Black1349'
        ]);
    }
}
