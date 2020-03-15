заказ #{{$number}} завершен
текст состав заказа
<?php
use App\Presentation\OrderDetail;
/* @var OrderDetail $detail */
$products = $detail->getProducts()
?>
@if (count($products) > 0 )
    @foreach ($products as $product)
        @include('email.order.product')
    @endforeach
@endif

стоимость заказа {{$detail->getCost()}} руб.
