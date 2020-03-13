<?php


namespace App\Http\Controllers;


class WeatherController extends Controller
{
    public function index()
    {
        $result = self::requestWeather();

        $data = [];
        if (empty($result['err'])) {
            $data = json_decode($result['response'], true);
        }

        return view('Weather.index',
            ['weather' => $data, 'err' => $result['err']]);
    }

    /**
     * @return array
     */
    private static function requestWeather(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.weather.yandex.ru/v1/forecast?lat=53.2520900&lon=34.3716700&lang=ru_RU&hours=false&extra=false",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "cache-control: no-cache",
                "Connection: keep-alive",
                "Host: api.weather.yandex.ru",
                "X-Yandex-API-Key: 72e5cb3c-ec73-4ce0-b530-b8999e9a1a2a",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = ['response' => $response, 'err' => $err];

        return $result;
    }

}