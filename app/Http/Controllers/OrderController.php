<?php


namespace App\Http\Controllers;


use App\Dictionary\Partners;
use App\Dictionary\Statuses;
use App\Http\LinkFabric;
use App\Http\Validation;
use App\Model\Order;
use App\Presentation\OrderDetail;
use App\Presentation\OrderSummary;
use App\Presentation\Pagination;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $link = (new LinkFabric())->toPage(0);

        return redirect($link);
    }

    public function list(string $page, string $limit)
    {
        $current = (int)$page;
        if ($current < 0) {
            $current = 0;
        }
        $perPage = (int)$limit;
        if (!($perPage > 0)) {
            $perPage = 20;
        }
        $orders = Order::with(Order::POSITIONS)
            ->offset($current * $perPage)->limit($perPage)
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

        $total = Order::query()->count();

        $links = (new Pagination())
            ->compose($current, $total, $perPage);

        return view('order.list',
            ['list' => $items, 'pages' => $links]);

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
            ['detail' => $detail, 'link' => $link,
                'number' => $identity,
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
        $isSuccess = $order->save();

        $result = null;
        if ($isSuccess) {
            $result = redirect(route('start'));
        }
        if (!$isSuccess) {
            $result = redirect(route('view-order-detail'))
                ->with('error', 'Сбой сохранения заказа');
        }

        return $result;
    }
}