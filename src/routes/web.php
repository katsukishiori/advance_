<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index']);
});

// '/reservation' ルートに 'auth' ミドルウェアを使用
// Route::middleware('auth')->group(function () {
//     // 予約するときだけ認証が必要なルート
//     Route::post('/reservation', [ReservationController::class, 'reservationShop']);
// });

Route::get('/', [ShopController::class, 'index']);

Route::post('/register', [AuthController::class, 'store']);
Route::post('/thanks', [ThanksController::class, 'access']);

Route::post('/login', [AuthController::class, 'login']);

// 登録したら/thanksに遷移
Route::get('/thanks', [ThanksController::class, 'store']);

Route::get('/detail/{slug}', [ShopController::class, 'show']);
Route::post('/detail/{slug}', [ReservationController::class, 'reservationShop']);
Route::get('/detail/{slug}', [ReservationController::class, 'index']);


// Route::get('/detail/{slug}', 'ReservationController@index')->name('detail.show');



//検索機能
Route::get('/search', [ShopController::class, 'search']);