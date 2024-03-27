@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">


@endsection

@section('content')

<div class="login__content">
    <div class="login-from__card">
        <form action="{{ url('/detail/{slug}') }}" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-content">ご予約ありがとうございます</div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="button" onclick="history.back()">戻る</button>
            </div>
        </form>
    </div>
</div>

@endsection