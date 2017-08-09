<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Lendings\Exceptions\Handler;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function disableExceptionHandling()
    {
        app()->instance(Handler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e)
            {
                // no-op
            }
            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });
    }
}
