<?php

namespace Darius\User\Tests\Unit;

use Darius\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_should_not_be_less_than_6_character()
    {
        $res = (new ValidPassword())->passes('', '45678');

        $this->assertEquals(0, $res);
    }

    public function test_password_should_include_sign_character()
    {
        $res = (new ValidPassword())->passes('', '45675448');

        $this->assertEquals(0, $res);
    }

    public function test_password_should_include_digit_character()
    {
        $res = (new ValidPassword())->passes('', '@A!dkjfad');

        $this->assertEquals(0, $res);
    }

    public function test_password_should_include_capital_character()
    {
        $res = (new ValidPassword())->passes('', '45!#7fg5448');

        $this->assertEquals(0, $res);
    }

    public function test_password_should_include_small_character()
    {
        $res = (new ValidPassword())->passes('', '456754!ASD#@48');

        $this->assertEquals(0, $res);
    }
}
