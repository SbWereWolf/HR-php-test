<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1, shrink-to-fit=no">
    <title>Order detail</title>
</head>
<body>
<form action="/order/store" method="post" class="form-horizontal">
    <h2>Редактировать заказ</h2>

    @include('common.partial.errors')

    <div class="controls">
        <?php /* @var $order */ ?>
        <div class="col-md-12">
            <div class="form-group">
                <label>email_клиента
                    <input type="text" value="{{ $order->customer }}"/>
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>партнер
                    <input type="text" value="{{ $order->partner }}"/>
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>продукты <span>{{ $order->positions }}</span>
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>статус заказа
                    <input type="text" value="{{ $order->status  }}"/>
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>стоимость заказ <span>{{ $order->cost }}</span>
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-success btn-send"
                   value="Сохранить"/>
        </div>

        {{ csrf_field() }}

    </div>
</form>
</body>
</html>
