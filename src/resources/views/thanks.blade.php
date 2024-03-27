@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<div class="login__content">
    <div class="login-from__card">

        <form class="form" action="/thanks" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">会員登録ありがとうございます</div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログインする</button>
            </div>
            <div>
        </form>
    </div>

@endsection