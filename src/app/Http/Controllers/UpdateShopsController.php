<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Prefecture;
use App\Models\Genre;
use App\Models\Shop;

class UpdateShopsController extends Controller
{
    //店舗更新画面へ移動する時に必要なコード
    public function index($shopId)
    {
        // ユーザーが所属する店舗のデータを取得
        $shop = Shop::find($shopId);
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        // 店舗データをビューに渡す
        return view('update_shops', compact('shop', 'prefectures', 'genres'));
    }

    public function edit(Request $request)
    {
        $shop = Shop::find($request->id);

        $prefectures = Prefecture::all();
        $genres = Genre::all();

        // ビューにデータを渡す
        return view('update_shops', compact('shop', 'prefectures', 'genres'));
    }

    public function update(Request $request, $id)
    {
        // フォームから送信されたデータを取得
        $shop = Shop::find($id);
        $shop->shop_name = $request->shop_name;
        $shop->prefecture_id = $request->prefecture;
        $shop->genre_id = $request->genre;
        $shop->shop_overview = $request->shop_overview;

        // 画像のアップロード処理
        if ($request->hasFile('document')) {
            // 古い画像が存在する場合、それを削除する
            if ($shop->shop_image) {
                Storage::delete('public/images/' . $shop->shop_image);
            }

            // 新しい画像をサーバーに保存
            $imageName = time() . '.' . $request->document->extension();
            $request->document->storeAs('public/images', $imageName);

            // 新しい画像のファイル名をデータベースに保存
            $shop->shop_image = $imageName;
        }

        // データベースに変更を保存
        $shop->save();

        // 更新完了メッセージをフラッシュ
        session()->flash('message', '店舗情報が更新されました');

        // 更新後にリダイレクト
        return redirect()->back();
    }
}
