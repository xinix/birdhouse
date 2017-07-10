<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_guests_can_create_an_account()
    {
        $this->signIn();

        $this->get('/register')
            ->assertRedirect('/home');

        $this->post('/register')
            ->assertRedirect('/home');
    }

    /** @test */
    public function when_a_user_creates_an_account_a_default_birdhouse_is_created()
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response = $this->getJson('/birdhouses')->json();

        $this->assertCount(1, $response);

    }
}
