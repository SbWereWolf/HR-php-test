<?php


namespace App\Presentation;

use App\Model\Order;
use App\Model\Partner;
use App\Model\Status;

class OrderDetail
{
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $customer;
    /**
     * @var string
     */
    private $partner;
    /**
     * @var int
     */
    private $cost;
    /**
     * @var array
     */
    private $products;

    private function __construct(
        string $status, string $customer, string $partner, int $cost,
        array $products)
    {
        $this->status = $status;
        $this->customer = $customer;
        $this->partner = $partner;
        $this->cost = $cost;
        $this->products = $products;
    }

    public static function make(
        Order $order, Partner $partner, Status $status,
        array $positions)
    {
        $email = (string)$order->client_email;
        $name = (string)$partner->name;
        $state = (string)$status->title;
        $cost = 0;
        $products = [];
        foreach ($positions as $position) {
            $quantity = (int)$position->quantity;
            $cost += $quantity * (int)$position->price;

            $products[] = ['title' => $position->product->name,
                'quantity' => $quantity];
        }

        return new static($state, $email, $name, $cost, $products);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
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
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}