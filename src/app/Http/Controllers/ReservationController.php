<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Evaluation;
use Illuminate\Support\Carbon;
use App\Http\Requests\ReservationRequest;


class ReservationController extends Controller
{
    // public function index($slug)
    // {
    //     // 予約情報の取得
    //     $reservations = Reservation::all();

    //     // 評価情報の取得
    //     $evaluations = Evaluation::all();

    //     // ビューにデータを渡して表示
    //     return view('detail', ['reservations' => $reservations, 'evaluations' => $evaluations]);
    // }


    public function done()
    {
        return view('done');
    }

    public function store(ReservationRequest $request)
    {

        // ログインユーザーの情報を取得
        $user = auth()->user();

        // ユーザーがログインしていない場合
        if (!$user) {
            // 未ログインの場合のリダイレクト
            return redirect('/login')->with('error', '予約するにはログインが必要です。');
        }

        $userId = auth()->id();
        $shopId = $request->input('shop_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $reservationCount = $request->input('reservation_count');

        // 予約データを保存
        Reservation::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
            'datetime' => "{$date} {$time}",
            'reservation_count' => $reservationCount,
        ]);

        return redirect('/done')->with('success', '予約が完了しました。');
    }



    public function reservationShop(Request $request, $slug = null)
    {
        // フォームから正しく日付と時間の値を取得
        $date = $request->input('date');
        $time = $request->input('time');

        // ログインユーザーの情報を取得
        $user = auth()->user();
        // ショップの情報を取得（$slug を使用して取得する前提）
        $shop = Shop::where('slug', $slug)->first();

        // 'date' インデックスが存在するか確認
        if (isset($date)) {
            // 日付と時間を結合して datetime カラムにセット
            $dateTimeString = "{$date} {$time}";

            $form = [
                'datetime' => Carbon::createFromFormat('Y-m-d H:i', $dateTimeString)->toDateTimeString(),
                'user_id' => $user->id, // ログインユーザーのIDを設定
                'shop_id' => $shop->id, // ショップのIDを設定
                'reservation_count' => $request->input('reservation_count'),
            ];

            Reservation::create($form);

            return view("detail.{$slug}", compact('form', 'shopData'));
        } else {
            // 'date' インデックスが存在しない場合のエラーハンドリング
            return redirect("detail.{$slug}")->with('error', '日付が指定されていません。');


            $evaluations = Evaluation::all();

            //     // ビューにデータを渡して表示
            return view('detail', ['evaluations' => $evaluations]);
        }

        throw Evaluation::withMessages([
            $this->username() => [trans('auth.failed')],
        ])->redirectTo('/login')->with('error', '投稿するにはログインが必要です。');
    }
}
