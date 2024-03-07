<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Leader</title>

    <link rel="stylesheet" href="{{ asset('css/shopleader.css') }}">
</head>

<body>

    <header class="header">
        <h1 class="header-ttl">
            <a href="index.html">
                店舗代表者ページ
            </a>
        </h1>
        <nav class="header-nav">
            <a class="header-nav" href="service.html">店舗作成画面へ</a>
        </nav>
    </header>

    <h1>予約状況</h1>

    <table>
        <tr>
            <th>id</th>
            <th>ユーザー名</th>
            <th>店舗名</th>
            <th>予約日時</th>
            <th>予約人数</th>
            <th>予約人数</th>
        </tr>

        @foreach ($reservations as $reservation)
        <tr>
            <td>{{$reservation->id}}</td>
            <td>
                @if ($reservation->user)
                {{ $reservation->user->name }}
                @else
                ゲストユーザー
                @endif
            </td>
            <td>{{ $reservation->shop->shop_name }}</td>
            <td>{{$reservation->datetime}}</td>
            <td>{{$reservation->reservation_count}}</td>
        </tr>
        @endforeach

    </table>

</body>