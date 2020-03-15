<?php

namespace Tests\Feature;

use App\Business\Notifier;
use App\Http\Controllers\OrderController;
use App\Model\Order;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testNotifier()
    {
        /* @var Order $order */
        $order = Order::query()->find(6);
        $notifier = new Notifier(OrderController::COMPLETED);
        $occur = $notifier->processStatusChange($order, 10);

        $this->assertTrue($occur);
    }

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
