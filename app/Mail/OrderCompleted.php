<?php

namespace App\Mail;

use App\Presentation\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var OrderDetail
     */
    private $detail;
    /**
     * @var int
     */
    private $number;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderDetail $detail, int $number)
    {
        $this->detail = $detail;
        $this->number = $number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('email.order.completed',
            ['detail' => $this->detail, 'number' => $this->number]);
    }
}
