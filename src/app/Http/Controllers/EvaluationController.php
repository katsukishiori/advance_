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

        // 評価画面にお店の情報を渡して表示
        return view('evaluation', ['shopData' => $shopData]);
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

            // Evaluation モデルを使用してデータベースに保存
            $evaluation = new Evaluation;
            $evaluation->user_id = $userId;
            $evaluation->shop_id = $shopId;
            $evaluation->nickname = $request->input('nickname');
            $evaluation->rating = $request->input('rating');
            $evaluation->comment = $request->input('textarea');

            $evaluation->save();

            // 成功したらリダイレクトまたは適切な応答を返す
            return redirect()->route('detail', ['shop_id' => $evaluation->shop_id]);
        } else {
            return redirect('/login')->with('error', 'ログインしてください');
        }
    }
}
