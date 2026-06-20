<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_guest_is_redirected_from_the_feed_to_login(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }
}
