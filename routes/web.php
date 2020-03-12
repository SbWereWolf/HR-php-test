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

use App\Http\Controllers\OrderController;
use App\Http\IRouting;
use Illuminate\Support\Facades\Route;

Route::get('/', OrderController::class . '@index')->name('start');
Route::get(
    '/orders-list/{' . IRouting::PAGE . '}/{' . IRouting::LIMIT . '}',
    OrderController::class . '@list')
    ->name(IRouting::LIST);
Route::get('/order-detail/{id}', OrderController::class . '@edit')
    ->name('view-order-detail');
Route::post('/order-detail/{id}', OrderController::class . '@store')
    ->name('write-order-detail');
