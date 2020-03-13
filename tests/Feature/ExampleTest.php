<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testWeather()
    {
        $response = $this->get('/weather/');

        $response->assertStatus(200);
    }

    public function testStartRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testDetailRoute()
    {
        $response = $this->get('/order-detail/15');

        $response->assertStatus(200);
    }
}
