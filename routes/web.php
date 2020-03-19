<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\IRouting;
use Illuminate\Support\Facades\Route;

Route::get('/', 'OrderController@index')->name('start');
Route::get(
    '/orders-list/{' . IRouting::LIMIT . '}',
    'OrderController@list')
    ->name(IRouting::LIST);
Route::get('/order-detail/{id}', 'OrderController@edit')
    ->name('view-order-detail');
Route::post('/order-detail/{id}', 'OrderController@store')
    ->name('write-order-detail');

Route::get('/weather/', 'WeatherController@index')
    ->name('weather');

Route::get('/product/', 'ProductController@index')
    ->name('product');
