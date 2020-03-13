<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1, shrink-to-fit=no">
    <title>Order detail</title>

    @include('common.partial.header-css')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-2 col-xs-1"></div>
        <div class="col-4 col-md-8 col-xs-10">
            @include('common.partial.come-back')
            <h2>Редактировать заказ #{{$number}}</h2>
            <form action="{{$link}}" method="post"
                  class="form-horizontal">
                @include('common.partial.errors')
                <div class="controls">
                    <?php
                    /* @var OrderDetail $detail */
                    use App\Presentation\OrderDetail;
                    /* @var array $statuses */
                    /* @var array $partners */
                    ?>
                    <div class="form-group">
                        <label>Клиент
                            <input type="text" name="customer"
                                   value="{{ $detail->getCustomer() }}"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Партнер
                            <select name="partner">
                                <?php $chosenPartner =
                                    $detail->getPartner() ?>
                                @foreach ($partners as $partner)
                                    @include('order.partial.partner')
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Продукты </label>
                        <?php $products = $detail->getProducts() ?>
                        @if (count($products) > 0 )
                            <ul>
                                @foreach ($products as $product)
                                    @include('order.partial.product')
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Статус
                            <select name="status">
                                <?php $state = $detail->getStatus() ?>
                                @foreach ($statuses as $status)
                                    @include('order.partial.status')
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Стоимость <span>
                        {{ $detail->getCost() }} руб.</span>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-success btn-send"
                           value="Сохранить"/>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-lg-4 col-md-2 col-xs-1"></div>
    </div>
</div>
</body>
@include('common.partial.footer-js')
</html>
