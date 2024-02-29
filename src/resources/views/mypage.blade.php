@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('title', 'my_page.blade.php')

@section('content')



<div class="header">
    @if (Auth::check())
    <h1>{{ Auth::user()->name }}さん</h1>
    @endif
</div>

<div class="flex">
    <!-------------- 予約状況 ------------------->
    <div class="box" style="width: 40%;">
        <h2>予約状況</h2>
        @foreach ($reservations as $reservation)
        @auth
        @if ($reservation->user_id == auth()->user()->id)
        <div class="reservation__card">
            <div class="card-title">
                <div class="left">
                    <i class="fas fa-clock"></i> <!-- 時計マーク -->
                    予約{{ $reservation->id }}
                </div>

                <div class="right">
                    <form action="{{ route('mypage.delete', $reservation->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <i class="fa-regular fa-circle-xmark" style="color: #fff; font-size:25px;"></i>
                        </button>
                    </form>
                </div>

            </div>
            <form action="{{ route('mypage.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <table>
                    <tr>
                        <th>Shop</th>
                        <td>{{ $reservation->shop->shop_name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>
                            <input type="date" name="date" value="{{ \Carbon\Carbon::parse($reservation->datetime)->format('Y-m-d') }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>
                            <input type="time" name="time" value="{{ \Carbon\Carbon::parse($reservation->datetime)->format('H:i') }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>
                            <input type="number" name="reservation_count" value="{{ $reservation->reservation_count }}">
                        </td>
                    </tr>
                </table>
                <div class="card__bottom">
                    <button class="card__bottom--button" type="submit">変更する</button>
                </div>
            </form>
        </div>
        @endif
        @endauth

        @endforeach
    </div>

    <!-------------- お気に入り店舗 ------------------->
    <div class="box" style="width: 60%;">
        <h2>お気に入り店舗</h2>
        <div class="flex__container">
            @foreach ($shops as $shop)
            <div class="shop__card">
                <div class="card__img">
                    <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
                </div>
                <div class="card__content">
                    <div class="card__cat">{{ $shop->shop_name }}</div>
                    <p class="card__ttl">
                        #{{ $shop->prefecture->prefecture_name }}
                        #{{ $shop->genre->genre_name }}
                    </p>
                    <div class="tag">
                        <a class="card__tag" href="{{ route('detail', ['slug' => $shop->slug]) }}">詳しく見る</a>

                        <!-- お気に入りボタン -->
                        <a href="" class="btn btn-primary" onclick="toggleFavorite(event, '{{ $shop->id }}')">
                            <i id="heartIcon{{ $shop->id }}" class="fas fa-heart" style="color: {{ auth()->user()->favoriteShops->contains($shop) ? 'red' : '#EEEEEE' }}; font-size: 30px;"></i>
                        </a>


                        <!-- ハートの色を変える -->
                        <script>
                            async function toggleFavorite(event, shopId) {
                                event.preventDefault();

                                var heartIcon = document.getElementById('heartIcon' + shopId);

                                if (heartIcon.style.color === 'red') {
                                    heartIcon.style.color = '#EEEEEE';
                                    await sendFavoriteStatusToServer(shopId, false);
                                } else {
                                    heartIcon.style.color = 'red';
                                    await sendFavoriteStatusToServer(shopId, true);
                                }
                            }

                            async function sendFavoriteStatusToServer(shopId, isFavorite) {
                                try {
                                    const response = await fetch('/favorites/add', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: JSON.stringify({
                                            shopId: shopId,
                                            isFavorite: isFavorite,
                                        }),
                                    });

                                    if (response.ok) {
                                        console.log('お気に入りの状態がサーバーに送信されました');
                                    } else {
                                        console.error('お気に入りの状態の送信に失敗しました');
                                    }
                                } catch (error) {
                                    console.error('エラーが発生しました', error);
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
<!-- .flex 終了 -->



@endsection