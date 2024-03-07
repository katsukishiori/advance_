<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Shop;

class EvaluationController extends Controller
{


    public function index(Request $request)
    {
        // リクエストからshop_idを取得
        $shopId = $request->input('shop_id');

        // $shopIdを使用してお店の情報を取得
        $shopData = Shop::find($shopId);

        // データベースから評価データを取得
        $evaluation = Evaluation::all();

        // 評価画面にお店の情報を渡して表示
        return view('evaluation', ['shopData' => $shopData, 'evaluation' => $evaluation]);
    }

    public function store(Request $request)
    {
        // ユーザーがログインしているか確認
        if (auth()->check()) {
            // ログインしているユーザーの情報を取得
            $user = auth()->user();

            // ユーザーIDを取得
            $userId = $user->id;

            // 評価対象の店舗情報をフォームから取得（仮の例）
            $shopId = $request->input('shop_id');

            // フォームから送信されたデータを取得
            $nickname = $request->input('nickname');
            $rating = $request->input('rating');
            $comment = $request->input('textarea');
            $photo = $request->file('photo'); // ファイルアップロードの場合

            // Evaluation モデルを使用してデータベースに保存
            $evaluation = new Evaluation;
            $evaluation->user_id = $userId;
            $evaluation->shop_id = $shopId;
            $evaluation->nickname = $nickname;
            $evaluation->rating = $rating;
            $evaluation->comment = $comment;

            // ファイルアップロードがあれば、適切な処理を追加
            if ($photo) {
                $path = $photo->store('photos'); // 適切なディレクトリに保存
                $evaluation->photo_path = $path;
            }

            $evaluation->save();

            // 成功したらリダイレクトまたは適切な応答を返す
            return redirect('/detail/{slug}');
        } else {
            // ログインしていない場合の処理
            // 例えばログインページにリダイレクトするなど
            return redirect('/login')->with('error', 'ログインしてください');
        }
    }

    public function show()
    {
        // evaluations テーブルから nickname, comment, rating のデータを取得
        $evaluations = Evaluation::all();

        // ビューにデータを渡す
        return view('detail', ['evaluations' => $evaluations]);
    }
}
