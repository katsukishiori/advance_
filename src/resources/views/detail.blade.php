@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')


<div class="flex">
    <!------------- 店舗詳細 -------------->
    <div class="box">
        <form action="/" method="get">
            <div class="shop-title">
                <input type="submit" class="return-btn" value="<" />

                <h1>{{ $shopData->shop_name }}</h1>
            </div>
            <img src="{{ asset('img/' . $shopData->shop_image) }}" alt="" />
            <p> #{{ $shopData->prefecture->prefecture_name }}
                #{{ $shopData->genre->genre_name }}</p>
            <p>{{ $shopData->shop_overview }}</p>
        </form>
    </div>


    <!------------- 予約カード -------------->
    <div class="box">
        <div class="card">
            <h1 class="title">予約</h1>
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



                <script>
                    // フォームの入力が変更されたときの処理
                    document.getElementById('date').addEventListener('change', updateDisplay);
                    document.getElementById('time').addEventListener('change', updateDisplay);
                    document.getElementById('reservation_count').addEventListener('change', updateDisplay);

                    // 初期表示
                    updateDisplay();

                    // フォームの値を表示に反映させる関数
                    function updateDisplay() {
                        document.getElementById('displayDate').innerText = document.getElementById('date').value;
                        document.getElementById('displayTime').innerText = document.getElementById('time').value;
                        document.getElementById('displayNumber').innerText = document.getElementById('reservation_count').value + '人';
                    }
                </script>

        </div>
        <!-- .card 終了 -->
    </div>
    <!-- .box 終了 -->
</div>
<!-- .flex 終了 -->
@endsection