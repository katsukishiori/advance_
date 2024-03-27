@extends('layouts.app')

@section('css')
<!-- <link rel="stylesheet" href="{{ asset('css/register.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスをご確認ください') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
                    </div>
                    @endif

                    {{ __('メールをご確認ください。') }}
                    {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('確認メールを再送信する') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection