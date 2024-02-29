<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>

<div class="shop-title">
    <form action="/" method="get">
        <input type="submit" class="return-btn" value="×" />
    </form>
</div>

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
        @endif
    </div>

</body>

</html>