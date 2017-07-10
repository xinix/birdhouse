<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        $this->throwExceptions();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        return $this->actingAs($user);
    }

    protected function throwExceptions()
    {
        $this->oldExceptionHandler = $this->app->make(Handler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) { throw $e; }
        });
    }

    protected function dontThrowExceptions()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
