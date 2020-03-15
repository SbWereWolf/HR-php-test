<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1, shrink-to-fit=no">
    <title>List of products</title>

    @include('common.partial.header-css')
</head>
<body>
<div class="container">
    <div class="row">
        @include('common.partial.come-back')
        <h1>Список заказов</h1>
        <div class="table-responsive">
            <table class="table-hover table-bordered">
                <thead>
                <tr>
                    <th>наименование_поставщика</th>
                    <th>ид_продукта</th>
                    <th>наименование_продукта</th>
                    <th>цена</th>
                </tr>
                </thead>
                <tbody>
                @isset($list)
                    @foreach ($list as $item)
                        @include('product.partial.detail')
                    @endforeach
                @endisset
                </tbody>
            </table>
            {{$paginate}}
        </div>
    </div>
</div>
</body>
@include('common.partial.footer-js')
</html>