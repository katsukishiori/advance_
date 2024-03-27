@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

@if(session('error'))

@endif



<div class="login__content">
    <div class="login-from__card">
        <div class="login-form__card--heading">
            <h2 class="login-form__card--ttl">Login</h2>
        </div>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">

                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <i class="fa-solid fa-envelope" style="font-size: 25px; padding-top: 10px;"></i>
                        <input type=" email" name="email" value="{{ old('email') }}" placeholder="Email" class="email" />
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <i class="fa-solid fa-lock" style="font-size: 25px; padding-top: 10px;"></i>
                        <input type="password" name="password" placeholder="Password" class="password" />
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
                <div>
        </form>
    </div>
    </body>
    @endsection