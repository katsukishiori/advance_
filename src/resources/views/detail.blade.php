@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<div class="flex">
    <!------------- 店舗詳細 -------------->
    <div class="box">
        <form action="/" method="get">
            <div class="shop-title">
                <input type="submit" class="return-btn" value="<" />

                <h2>{{ $shopData->shop_name }}</h2>
            </div>
            <img src="{{ asset('storage/images/' . $shopData->shop_image) }}" alt="店舗画像">
            <p> #{{ $shopData->prefecture->prefecture_name }}
                #{{ $shopData->genre->genre_name }}</p>
            <p>{{ $shopData->shop_overview }}</p>
        </form>
    </div>

    <!------------- 予約カード -------------->
    <div class="box">
        <div class="card">
            <h2 class="title">予約</h2>
            <form action="{{ route('reservation.store') }}" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shopData->id }}">
                <div class="form__input">
                    <label for="date"></label>
                    <input type="date" id="date" name="date" value="{{ now()->toDateString() }}" required>

                </div>
                <div class="form__input">
                    <label for="time"></label>
                    <input type="time" id="time" name="time" value="{{ now()->format('H:i') }}" required>
                </div>
                <div class="form__input">
                    <label for="reservation_count"></label>
                    <input type="number" id="reservation_count" name="reservation_count" value="1" min="1" max="100" required>
                </div>

                @if($errors->has('date'))
                <p style="color: red; font-size: 16px; line-height: 1;">{{ $errors->first('date') }}</p>
                @endif
                <div class="card__bottom">
                    <button class="card__bottom--button" type="submit">予約する</button>
                </div>

                <div class="form__display">
                    <table id="displayTable">
                        <tr>
                            <th>Shop</th>
                            <td>{{ $shopData->shop_name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td id="displayDate"><?php echo date('Y-m-d'); ?></td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td id="displayTime"><?php echo date('H:i'); ?></td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td id="displayNumber"><span id="unit">1人</span></td>
                        </tr>
                    </table>
                </div>

        </div>
        <!-- .card 終了 -->
    </div>
    <!-- .box 終了 -->
</div>
<!-- .flex 終了 -->

<div class="evaluation-btn">
    @if(auth()->check())
    <a class="evaluation-btn" href="/evaluation?shop_id={{ $shopData->id }}">評価する</a>
    @else
    <a class="evaluation" href="{{ url('/login') }}">評価する</a>
    @endif
</div>

<div class="evaluation-list">
    <h3>みんなの口コミ</h3>
    @if(isset($evaluations) && $evaluations->count() > 0)

    @foreach ($evaluations as $evaluation)
    <div class="evaluation-item">
        <div class="evaluation-nickname">
            <h4>{{ $evaluation->nickname }}</h4>
        </div>

        <div class="rating-container">
            <div id="rating">
                @for ($i = 1; $i <= 5; $i++) <i class="fas fa-star {{ $i <= ($evaluation->rating ?? 0) ? 'active' : '' }}" data-index="{{ $i }}"></i>
                    @endfor
            </div>
        </div>

        <div class="evaluation-comment">
            {{ $evaluation->comment }}
        </div>
    </div>
    @endforeach


    @else
    <div class="no-evaluation">
        <p>まだ口コミがありません。</p>
    </div>
    @endif





    @endsection