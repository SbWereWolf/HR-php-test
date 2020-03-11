<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1, shrink-to-fit=no">
    <title>List of orders</title>
</head>
<body>
<table>
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
@isset($pages)
    @include('common.partial.pagination')
@endisset
</body>
</html>
