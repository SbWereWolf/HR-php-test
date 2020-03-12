<?php


namespace App\Http\Controllers;


use App\Model\Order;
use App\Presentation\OrderSummary;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Показать все сообщения
     *
     * @return View
     */
    public function index()
    {
        $orders = Order::with(Order::POSITIONS)->get()->all();
        $items = [];
        foreach ($orders as $order) {
            /* @var Order $order */
            $summary = OrderSummary::make(
                $order, $order->partner, $order->state,
                $order->positions->all());

            $link = route('detail', ['id' => $order->id]);

            $items[] = ['summary' => $summary, 'link' => $link];
        }

        return view('order.list', ['list' => $items]);
    }

    public function detail(string $id)
    {

        return view('order.detail', ['id' => $id]);
    }
}