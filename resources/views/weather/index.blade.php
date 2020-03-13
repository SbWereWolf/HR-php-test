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
        @include('common.partial.come-back')
        <h1>Погода</h1>
        <?php
        /* @var array $weather */
        /* @var array $err */
        $isFail = !empty($err)
            || empty($weather);
        ?>
        @if ($isFail)
            <p>
                Сбой определения погоды, само пройдёт, дело то житейское
            </p>
        @endif
        @if (!$isFail)
            <p>
                <img alt="Иконка погоды"
                     src=
                     "https://yastatic.net/weather/i/icons/blueye/color/svg/{{$weather['fact']['icon']}}.svg"/>
            </p>
            <dl>
                <dt>Температура</dt>
                <dd>{{$weather['fact']['temp']}}</dd>
                <dt>Температура по ощущения</dt>
                <dd>{{$weather['fact']['feels_like']}}</dd>
                <dt>Влажность</dt>
                <dd>{{$weather['fact']['humidity']}}</dd>
                <dt>Скорость ветра</dt>
                <dd>{{$weather['fact']['wind_speed']}}</dd>
                <dt>Порывы ветра</dt>
                <dd>{{$weather['fact']['wind_gust']}}</dd>
            </dl>
        @endif
    </div>
</div>
</body>
@include('common.partial.footer-js')
</html>
