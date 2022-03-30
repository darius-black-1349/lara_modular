<?php

namespace Darius\User\Tests\Unit;

use Darius\User\Services\VerifyCodeService;
use Tests\TestCase;


class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_is_6_digits()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code, 'generated code is not numeric');
        $this->assertLessThanOrEqual(999999, $code, 'generated code is less than 999999');
        $this->assertGreaterThanOrEqual(100000, $code, 'generated code is greater than 999999');
    }

    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1, $code, 120);
        $this->assertEquals($code, cache()->get('verify_code_1'));
    }
}
