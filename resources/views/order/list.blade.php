<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1, shrink-to-fit=no">
    <title>List of orders</title>

    @include('common.partial.header-css')
</head>
<body>
<div class="container">
    <div class="row">
        <ul>
            <li>
                <a href="{{route('weather')}}">Посмотреть погоду</a>
            </li>
            <li>
                <a href="{{route('product')}}">Изменить цены на продукты</a>
            </li>
        </ul>
        <h1>Список заказов</h1>
        <div class="table-responsive">
            <table class="table-hover table-bordered">
                <thead>
                <tr>
                    <th>ид_заказа</th>
                    <th>название_партнера</th>
                    <th>стоимость_заказа</th>
                    <th>наименование_состав_заказа</th>
                    <th>статус_заказа</th>
                </tr>
                </thead>
                <tbody>
                @isset($list)
                    @foreach ($list as $item)
                        @include('order.partial.summary')
                    @endforeach
                @endisset
                </tbody>
            </table>
            {{$pagination}}
        </div>
    </div>
</div>
</body>
@include('common.partial.footer-js')
</html>
