<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopLeaderController;
use App\Http\Controllers\CreateShopsController;
use App\Http\Controllers\UpdateShopsController;

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



Route::post('/register', [AuthController::class, 'store']);
Route::get('/', [AuthController::class, 'login']);
// role_id が 1 のユーザーがアクセスできるルート
Route::middleware(['checkRole:1'])->group(function () {
    Route::get('/confirm_reservation', [ShopLeaderController::class, 'index'])->name('confirm_reservation');
    Route::get('/create_shops', [CreateShopsController::class, 'index'])->name('create_shops');
    Route::get('/update_shops/{shop_id}', [UpdateShopsController::class, 'index'])->name('update_shops.show');
    Route::get('/create_shopleaders', [AdminController::class, 'index'])->name('create_shopleaders');
});
// role_id が 2 のユーザーがアクセスできるルート
Route::middleware(['checkRole:2'])->group(function () {
    Route::get('/confirm_reservation_2', [ShopLeaderController::class, 'index'])->name('confirm_reservation_2');
    Route::get('/create_shops_2', [CreateShopsController::class, 'index'])->name('create_shops_2');
    Route::get('/update_shops_2/{shop_id}', [UpdateShopsController::class, 'index'])->name('update_shops_2');
});
//店舗情報更新
Route::post('/update_shops/{shop_id}', [UpdateShopsController::class, 'update'])->name('update_shops.update');
//店舗情報追加
Route::post('/create_shops', [CreateShopsController::class, 'create']);
//店舗代表者作成
Route::post('/create_shopleaders', [AdminController::class, 'create']);
// 飲食店一覧画面表示
Route::get('/', [ShopController::class, 'index']);
// 飲食店詳細表示
Route::get('/detail/{shop_id}', [ShopController::class, 'show'])->name('show');
// 検索
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{shop_id}', [ReservationController::class, 'index'])->name('shop.detail');
// 予約するときだけ認証が必要なルート
Route::post('/reservation', [ReservationController::class, 'reservationShop'])->middleware('auth');
// 予約処理
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
// /doneの戻るボタンを押した後、飲食店詳細画面に戻る
Route::post('/detail/{shop_id}', [ReservationController::class, 'reservationShop'])->name('detail');
// 予約した後に/doneに移動
Route::get('/done', [ReservationController::class, 'done'])->name('done');

// Thankページ表示(登録したら/thanksに移動)
Route::get('/thanks', [ThanksController::class, 'store']);
// ログインするボタンを押したらログイン画面に移動
Route::post('/thanks', [ThanksController::class, 'access']);
// お気に入り
Route::post('/favorites/add', [FavoriteController::class, 'addFavorite'])->name('favorites.add');
// メニュー画面表示
Route::get('/menu', [MenuController::class, 'index']);
// マイページ表示
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
// 予約削除
Route::delete('/mypage/delete/{id}', [MyPageController::class, 'remove'])->name('mypage.delete');
// 予約更新
Route::patch('/mypage/{id}/update', [MyPageController::class, 'update'])->name('mypage.update');
//口コミ画面表示
Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation');
//口コミ情報処理
Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
