<?php

namespace Darius\User\Tests\Unit;

use Darius\User\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_can_not_be_less_than_10_character()
    {
        $res = (new ValidMobile())->passes('', '939567897');

        $this->assertEquals(0, $res);
    }

    public function test_mobile_can_not_be_more_than_10_character()
    {
        $res = (new ValidMobile())->passes('', '93956789771');

        $this->assertEquals(0, $res);
    }

    public function test_mobile_should_start_by_9_character()
    {
        $res = (new ValidMobile())->passes('', '3939567897');

        $this->assertEquals(0, $res);
    }
}
