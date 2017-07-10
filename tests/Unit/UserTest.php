<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function when_a_user_is_created_a_default_birdhouse_is_created()
    {
        $user = create('App\User');
        $this->assertCount(1, $user->birdhouses);
    }
}
