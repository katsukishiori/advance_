<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Support\Carbon;


class ReservationController extends Controller
{


    // public function reservationShop(Request $request, $slug)
    // {
    //     $form = $request->all();
    //     Reservation::create($form);
    //     return redirect("/detail/{$slug}");
    // }

    public function index($slug)
    {

        // $shops = Shop::all();
        // return view('shop', ['shops' => $shops]);

        $reservations = Reservation::all();
        return view("/detail/{$slug}", ['reservations' => $reservations]);
    }





    // public function reservationShop(Request $request, $slug)
    // {
    //     $form = $request->all();

    //     // ユーザーがログインしているか確認
    //     if (Auth::check()) {
    //         // ログイン中のユーザーのIDを取得
    //         $user_id = Auth::id();
    //         // $user_id を予約データに設定
    //         $form['user_id'] = $user_id;


    //         // 日付と時間を結合して datetime カラムにセット
    //         $dateTimeString = "{$form['date']} {$form['time']}";

    //         // time フィールドのフォーマットが '15:04' の場合
    //         $form['datetime'] = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString)->toDateTimeString();

    //         // 不要な date と time カラムを削除
    //         unset($form['date'], $form['time']);
    //     } else {
    //         // ログインしていない場合の適切な処理を行うか、エラーを返すなど
    //         // 例: return redirect('/login')->with('error', 'ログインが必要です');
    //     }

    //     Reservation::create($form);
    //     return redirect("/detail/{$slug}");
    // }



    // public function reservationShop(Request $request, $slug)
    // {
    //     // フォームから正しく日付と時間の値を取得
    //     $date = $request->input('date');
    //     $time = $request->input('time');

    //     // 日付と時間を結合して datetime カラムにセット
    //     $dateTimeString = "{$date} {$time}";

    //     // Carbon インスタンスを作成
    //     $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);

    //     // フォームデータの準備
    //     $form = [
    //         'datetime' => $dateTime->toDateTimeString(),
    //         // 他のフォームデータ（必要に応じて）
    //     ];

    //     // 他の処理（例: バリデーションやモデルへの保存）...

    //     Reservation::create($form);

    //     return redirect("/detail/{$slug}");
    // }



    public function reservationShop(Request $request, $slug)
    {
        // フォームから正しく日付と時間の値を取得
        $date = $request->input('date');
        $time = $request->input('time');

        // 'date' インデックスが存在するか確認
        if (isset($date)) {
            // 日付と時間を結合して datetime カラムにセット
            $dateTimeString = "{$date} {$time}";

            // time フィールドのフォーマットが '15:08' の場合
            $form['datetime'] = Carbon::createFromFormat(
                'Y-m-d H:i',
                $dateTimeString
            )->toDateTimeString();

            // 不要な date と time カラムを削除
            unset($form['date'], $form['time']);

            // 他の処理（例: バリデーションやモデルへの保存）...

            Reservation::create($form);

            return redirect("/detail/{$slug}");
        } else {
            // 'date' インデックスが存在しない場合のエラーハンドリング
            // 例えば、リダイレクトやエラーメッセージを表示するなど
            return redirect("/detail/{$slug}")->with('error', '日付が指定されていません。');
        }
    }
}
