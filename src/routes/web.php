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
use App\Http\Controllers\ModifyDetailsController;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\ShopLeaderMiddleware;

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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/create_shopleaders/dashboard', [AdminController::class, 'dashboard'])->name('create_shopleaders.dashboard');
Route::get('/confirm/reservation/dashboard', [ShopLeaderController::class, 'dashboard'])->name('confirm_reservation.dashboard');
Route::get('/user/dashboard', [AuthController::class, 'dashboard'])->name('user.dashboard');




// Route::middleware([AdminMiddleware::class])->group(
//     function () {
//         Route::get('/create_shopleaders', [AdminController::class, 'index'])->name('create_shopleaders.dashboard');
//         Route::get('/confirm_reservation', [ShopLeaderController::class, 'index'])->name('confirm_reservation.dashboard');
//     }
// );

// Route::middleware([ShopLeaderMiddleware::class])->group(
//     function () {
//         Route::get('/confirm_reservation', [ShopLeaderController::class, 'index'])->name('confirm_reservation.dashboard');
//     }
// );

// role_id が 1 のユーザーがアクセスできるルート
Route::middleware(['admin'])->group(function () {
    Route::get('/confirm_reservation', [ShopLeaderController::class, 'confirmReservation'])->name('confirm_reservation');
    Route::get('/modify_details', [ModifyDetailsController::class, 'index'])->name('modify_details');
    Route::get('/create_shopleaders', [AdminController::class, 'index'])->name('create_shopleaders');
});

// role_id が 2 のユーザーがアクセスできるルート
Route::middleware(['shopleader'])->group(function () {
    Route::get('/confirm_reservation', [ShopLeaderController::class, 'index'])->name('confirm_reservation');
    Route::get('/modify_details', [ModifyDetailsController::class, 'index'])->name('modify_details');
});




// 飲食店一覧画面表示
Route::get('/', [ShopController::class, 'index']);
// 飲食店詳細表示
Route::get('/detail/{slug}', [ShopController::class, 'show'])->name('detail');
// 検索
Route::get('/search', [ShopController::class, 'search']);
Route::get('/shop/{shopId}', [ShopController::class, 'showShopDetails']);

Route::get('/detail/{shop_id}', [ReservationController::class, 'index'])->name('index');
// 予約するときだけ認証が必要なルート
Route::post('/reservation', [ReservationController::class, 'reservationShop'])->middleware('auth');
// 予約処理
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
// /doneの戻るボタンを押した後、飲食店詳細画面に戻る
Route::post('/detail/{slug}', [ReservationController::class, 'reservationShop'])->name('detail');
// 予約した後に/doneに移動
Route::get('/done', [ReservationController::class, 'done'])->name('done');
// 登録
Route::post('/register', [AuthController::class, 'store']);
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

//予約追加
// Route::get('/mypage', [MyPageController::class, 'add'])->name('mypage');

//口コミ画面表示
Route::get('/evaluation', [EvaluationController::class, 'index']);
//口コミ情報処理
Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');

//店舗代表者作成
Route::post('/create_shopleaders', [ShopLeaderController::class, 'create']);
//店舗情報追加
Route::post('/modify_details', [ModifyDetailsController::class, 'create']);
