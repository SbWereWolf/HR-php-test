<?php


namespace App\Presentation;


use App\Model\Order;
use App\Model\Partner;
use App\Model\Status;

class OrderSummary
{
    const GLUE = ', ';
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $partner;
    /**
     * @var int
     */
    private $cost;
    /**
     * @var string
     */
    private $products;
    /**
     * @var string
     */
    private $status;

    private function __construct(
        int $id, string $status, string $partner, int $cost, string $products)
    {
        $this->id = $id;
        $this->status = $status;
        $this->partner = $partner;
        $this->cost = $cost;
        $this->products = $products;
    }

    public static function make(
        Order $order, Partner $partner, Status $status,
        array $positions)
    {
        $id = $order->id;
        $name = $partner->name;
        $state = $status->title;

        $cost = 0;
        $products = '';
        foreach ($positions as $position) {
            $cost += $position->quantity * $position->price;

            $products = "$products{$position->product->name}:"
                . " {$position->quantity} шт *"
                . " {$position->price} руб."
                . self::GLUE;
        }
        $products = trim($products, self::GLUE);

        return new static($id, $state, $name, $cost, $products);

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPartner(): string
    {
        return $this->partner;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getProducts(): string
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}