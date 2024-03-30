<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        $userId = auth()->id();
        $shopId = $request->input('shopId');
        $isFavorite = $request->input('isFavorite');

        // お気に入りの状態を切り替える
        if ($isFavorite) {
            // ユーザーがお気に入りに追加する場合の処理
            Favorite::create(['user_id' => $userId, 'shop_id' => $shopId]);
        } else {
            // ユーザーがお気に入りを解除する場合の処理
            Favorite::where(['user_id' => $userId, 'shop_id' => $shopId])->delete();
        }

        return response()->json(['message' => 'お気に入りの状態が更新されました']);
    }
}
