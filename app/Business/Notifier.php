<?php


namespace App\Business;


use App\Mail\OrderCompleted;
use App\Model\Order;
use App\Presentation\OrderDetail;
use Illuminate\Support\Facades\Mail;

class Notifier
{
    /**
     * @var int
     */
    private $completed;

    public function __construct(int $completed)
    {
        $this->completed = $completed;
    }

    /**
     * @param int $previous
     * @return bool
     */
    public function processStatusChange(Order $order, int $previous)
    {
        $current = (int)$order->status;
        $letNotify =
            $current !== $previous && $current === $this->completed;

        $emails = [];
        $positions = [];
        $partner = null;
        $index = 0;
        if ($letNotify) {
            $partner = $order->partner;
            $email = (string)$partner->email;
            $emails[$email] = $index++;
            $positions = $order->positions->all();

            foreach ($positions as $position) {
                $email = $position->product->vendor->email;
                $emails[$email] = $index++;
            }
        }

        $isSuccess = !empty($emails);
        if ($isSuccess) {

            $detail = OrderDetail::make(
                $order, $partner, $order->state,
                $positions);
            $number = (int)$order->id;
            $addressee = array_flip($emails);

            /** @noinspection PhpUndefinedMethodInspection */
            Mail::bcc($addressee)
                ->send(new OrderCompleted($detail, $number));
        }

        return $isSuccess;
    }
}