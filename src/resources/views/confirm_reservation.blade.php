@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm_reservation.css') }}">
@endsection

@section('content')
<body>
    <div class="reservation-list">
        <h2>予約状況</h2>

        <table>
            <tr>
                <th>id</th>
                <th>ユーザー名</th>
                <th>店舗名</th>
                <th>予約日時</th>
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
    </div>

</body>
@endsection