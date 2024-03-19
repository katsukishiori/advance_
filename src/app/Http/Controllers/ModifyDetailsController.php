<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\Genre;
use App\Models\Shop;

class ModifyDetailsController extends Controller
{
    public function index()
    {
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        // ビューに $prefectures 変数を渡す
        return view('modify_details', compact('prefectures', 'genres'));
    }

    public function create(Request $request)
    {
        // フォームから画像を取得
        $image = $request->file('document');

        if ($image) {
            // 画像を保存するディレクトリを指定
            $directory = 'public/images';

            // 保存するファイル名を生成
            $name = $image->getClientOriginalName();

            // 画像を指定したディレクトリに移動
            $path = $image->storeAs($directory, $name);

            // Shopモデルを使用してデータベースに保存
            $shop = new Shop();
            $shop->shop_image = $name;

            $shop->shop_name = $request->shop_name;
            $shop->prefecture_id = $request->prefecture_id;
            $shop->genre_id = $request->genre_id;
            $shop->shop_overview = $request->shop_overview;

            $shop->save();

            session()->flash('message', '店舗が作成されました');
        }

        return redirect('/modify_details');
    }
}
