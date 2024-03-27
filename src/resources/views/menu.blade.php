<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>

<div class="shop-title">
    <button onclick="goBack()" class="return-btn">×</button>
</div>

<script>
    function goBack() {
        // ブラウザの履歴を1つ前に戻る
        window.history.back();
    }
</script>

<body>
    <!-- ログインしている時に非表示 -->
    <div class="header">
        @guest
        <form class="form" action="" method="post">
            @csrf
            <a href="/" class="button">Home</a><br />
        </form>


        <form class="form" action="/logout" method="post">
            @csrf
            <a href="/register" class="button">Registration</a><br />
        </form>

        <form class="form" action="" method="post">
            @csrf
            <a href="/login" class="button">Login</a><br />
        </form>
        @endguest
    </div>



    <!-- ログインしている時に表示 -->
    <div class="header">
        @if (Auth::check())
        <form class="form" action="" method="post">
            @csrf
            <a href="/" class="button">Home</a><br />
        </form>


        <form class="form" action="/logout" method="post">
            @csrf
            <button type="submit" class="logout__button">Logout</button>
        </form>

        <form class="form" action="" method="post">
            @csrf
            <a href="/mypage" class="button">Mypage</a><br />
        </form>

        @can('admin')
        <a href="/user/admin" class="auth-btn auth-btn--text">
            管理者ページへ
        </a>
        @endcan

        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <form class="form" action="/create_shopleaders" method="post">
            @csrf
            <a href="/confirm_reservation" class="button">Confirm Reservation</a><br />
        </form>



        <form class="form" action="/modify_detail" method="post">
            @csrf
            <a href="/create_shops" class="button">Create Shops & Update Shops</a><br />
        </form>
        @endif
        @if(Auth::user()->role_id == 1)
        <form class="form" action="/confirm_reservation" method="post">
            @csrf
            <a href="/create_shopleaders" class="button">Create Shop Leaders</a><br />
        </form>
        @endif
        @endauth
    </div>

</body>

</html>