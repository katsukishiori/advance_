<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Genre;

class ShopController extends Controller
{
    public function index()
    {
        // リレーションで紐づいたエリアとジャンルの取得
        $shops = Shop::with(['prefecture', 'genre'])
            ->where('id', '!=', 999)
            ->get();
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('shop', compact('shops', 'prefectures', 'genres'));
    }

    //それぞれの店舗情報を表示する
    public function show($shop_id)
    {
        $shopData = Shop::findOrFail($shop_id);
        return view(
            'detail',
            compact('shopData')
        );
    }

    //検索機能
    public function search(Request $request)
    {
        $shopsQuery = Shop::with(['prefecture', 'genre']);

        if ($request->filled('prefecture_id') && $request->filled('genre_id')) {
            if ($request->prefecture_id === 'all' && $request->genre_id === 'all') {
            } elseif ($request->prefecture_id === 'all') {
                // 都道府県に対するすべてのジャンルが選択された場合
                $shopsQuery->whereHas('genre', function ($query) use ($request) {
                    $query->where('id', $request->genre_id);
                });
            } elseif ($request->genre_id === 'all') {
                // ジャンルに対するすべての都道府県が選択された場合
                $shopsQuery->whereHas('prefecture', function ($query) use ($request) {
                    $query->where('id', $request->prefecture_id);
                });
            } else {
                // 特定の都道府県とジャンルが選択された場合
                $shopsQuery->GenreSearch($request->genre_id)->where('prefecture_id', $request->prefecture_id);
            }
        } elseif ($request->filled('prefecture_id')) {
        } elseif ($request->filled('genre_id')) {
        }

        // KeywordSearch
        if ($request->filled('keyword')) {
            $shopsQuery->KeywordSearch($request->keyword);
        }

        //店舗の部分検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $shopsQuery->where('shop_name', 'LIKE', "%$keyword%");
        }

        // 完成したクエリを取得
        $shops = $shopsQuery->get();
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('shop', compact('shops', 'prefectures', 'genres'));
    }
}
