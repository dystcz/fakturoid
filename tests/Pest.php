<?php

use Illuminate\Foundation\Testing\TestCase as IlluminateTestCase;
use Orchestra\Testbench\TestCase;

/**
 * $this helper.
 */
function using($test): TestCase
{
    /** @var IlluminateTestCase $test */
    return $test;
}
