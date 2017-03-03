<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    function I_am_a_test_call()
    {
        $message = 'Im a test call';

        $this->assertEquals($message, 'Im a test call');
    }
}
