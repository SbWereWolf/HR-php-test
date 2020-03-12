<?php


namespace App\Http\Controllers;


use App\Dictionary\Partners;
use App\Dictionary\Statuses;
use App\Http\Validation;
use App\Model\Order;
use App\Presentation\OrderDetail;
use App\Presentation\OrderSummary;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return redirect(
            route('orders-list', ['page' => 0, 'limit' => 20]));
    }

    public function list(string $page, string $limit)
    {
        $current = (int)$page;
        $amount = (int)$limit;
        $orders = Order::with(Order::POSITIONS)
            ->offset((int)$current * $amount)->limit($amount)
            ->get()->all();

        $items = [];
        foreach ($orders as $order) {
            /* @var Order $order */
            $summary = OrderSummary::make(
                $order, $order->partner, $order->state,
                $order->positions->all());

            $link = route('view-order-detail',
                ['id' => $order->id]);

            $items[] = ['summary' => $summary, 'link' => $link];
        }

        return view('order.list', ['list' => $items]);

    }

    public function edit(string $id)
    {
        $statuses = Statuses::get();
        $partners = Partners::get();

        $identity = (int)$id;
        $link = route('write-order-detail', ['id' => $identity]);

        $order = Order::with(Order::POSITIONS)->find($identity);

        $detail = OrderDetail::make(
            $order, $order->partner, $order->state,
            $order->positions->all());

        return view('order.detail',
            ['detail' => $detail, 'link' => $link, 'number' => $identity,
                'statuses' => $statuses, 'partners' => $partners]);
    }

    public function store(Request $request, string $id)
    {
        $parameters = $request->all();
        Validation::beforeStore($parameters)->validate();

        $customer = htmlspecialchars($parameters['customer'] ?? '');
        $partner = (int)($parameters['partner'] ?? 0);
        $status = (int)($parameters['status'] ?? 0);

        $identity = (int)$id;
        $order = Order::query()->find($identity);

        $order->client_email = $customer;
        $order->partner_id = $partner;
        $order->status = $status;
        $order->save();

        return redirect(route('start'));
    }
}