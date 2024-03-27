@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="register__content">
    <div class="register-from__card">
        <div class="register-form__card--heading">
            <h2 class="register-form__card--ttl">Registration</h2>
        </div>
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">

                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <i class="fa-solid fa-user" style="font-size: 25px; padding-top: 10px;"></i>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Username" class="user-name" />
                        <div class="form__error">
                            @error('name')
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
                        <i class="fa-solid fa-envelope" style="font-size: 25px; padding-top: 10px;"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="email" />
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
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
    @endsection