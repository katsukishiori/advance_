@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sennin.css') }}">

@endsection

@section('content')

<div class="flex">
    <!------------- 店舗詳細 -------------->
    <div class="box">
        <h1>仙人</h1>
        <img class="img" src="{{ asset('public/img' . ($param['shop_image'] ?? '')) }}" alt="" />

    </div>




    <!------------- 予約カード -------------->
    <div class="box">
        <div class="card">
            <h1 class="title">予約</h1>
            <form class="form" action="/detail/sennin" method="post">
                @csrf
                <div class="form__input">

                    <input type="date" id="inputDate" name="datetime" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form__input">
                    <input type="time" id="inputTime" class="text" name="datetime" value="<?php echo date('H:i'); ?>">
                </div>
                <div class="form__input">
                    <input type="number" id="inputNumber" class="text" name="reservation_count" value="1" min="1" max="100">
                </div>


                <!-- テーブルに表示 -->
                <div class="form__display">
                    <table id="displayTable">
                        <tr>
                            <th>Shop</th>
                            <td>仙人</td>
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
                <div class="card__bottom">
                    <button class="card__bottom--button" type="submit">予約する</button>
                </div>
        </div>
        </form>

        <script>
            document.addEventListener('input', function() {
                const inputNumber = document.getElementById('inputNumber').value;
                document.getElementById('displayNumber').innerHTML = inputNumber + '<span id="unit">人</span>';
            });
        </script>


    </div>

</div>





@endsection