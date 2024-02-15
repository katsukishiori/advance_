<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Genre;
use App\Models\Reservation;


class ShopController extends Controller
{
    public function index()
    {
        // $shops = Shop::all();
        // return view('shop', ['shops' => $shops]);


        // リレーションで紐づいたエリアとジャンルの取得
        $shops = Shop::with(['prefecture', 'genre'])->get();
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('shop', compact('shops', 'prefectures', 'genres'));
    }

    //検索機能
    // public function search(Request $request)
    // {
    //     $shops = Shop::with('prefecture')->PrefectureSearch($request->prefecture_id)->KeywordSearch($request->keyword)->get();
    //     $prefectures = Prefecture::all();

    //     $shops = Shop::with('genre')->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
    //     $genres = Genre::all();

    //     return view('shop', compact('shops', 'genres'));
    // }


    public function search(Request $request)
    {
        $shopsQuery = Shop::with(['prefecture', 'genre']);

        // PrefectureSearch
        if ($request->filled('prefecture_id')) {
            $shopsQuery->PrefectureSearch($request->prefecture_id);
        }

        // GenreSearch
        if ($request->filled('genre_id')) {
            $shopsQuery->GenreSearch($request->genre_id);
        }

        // KeywordSearch
        if ($request->filled('keyword')) {
            $shopsQuery->KeywordSearch($request->keyword);
        }

        // 完成したクエリを取得
        $shops = $shopsQuery->get();

        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('shop', compact('shops', 'prefectures', 'genres'));
    }











    public function show($slug)
    {
        // $shop パラメータを使用して特定の店舗を取得
        $shop = Shop::where('slug', $slug)->first();

        // もし $shop が存在する場合、slug を取得して動的なビューを表示
        if ($shop) {
            // 数値の場合とそれ以外の場合でビュー名を適切に指定
            $viewName = is_numeric($slug) ? "detail.{$slug}" : "detail.{$shop->slug}";

            return view($viewName, ['shop' => $shop]);
        } else {
            // $shop が存在しない場合、エラーなどの処理を追加するか、適当なデフォルトのビューを表示するなどの処理を行うことができます。
            abort(404); // 404エラーを表示する例
        }
    }
}
