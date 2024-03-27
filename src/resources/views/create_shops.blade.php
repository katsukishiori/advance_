<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/create_shops.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>






<header class="header">
    <div class="header__inner">
        <div class="header-utilities">
            <form action="/menu" method="get" class="menu-icon">
                <a class="form-btn" href="/menu">
                    <div class="icon-line">
                        <span class="line" style="width: 10px;"></span>
                        <span class=" line" style="width: 20px;"></span>
                        <span class="line" style="width: 5px;"></span>
                    </div>
                    </button>
                    <a class="header__logo" href="/">Rese</a>
            </form>

        </div>
    </div>

    <nav class="header-nav">
        <a class="header-nav__btn" href="/update_shops/{{ Auth::user()->userShop->shop_id }}">店舗更新画面へ</a>

    </nav>
</header>

<div class="create_shops">
    <div class="create_shop-ttl">
        <h1>店舗作成</h1>
    </div>

    @if(session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif

    <form action="/create_shops" method="post" enctype="multipart/form-data">
        @csrf
        <table class="create_shops-table">
            <tr>
                <th>店舗名</th>
                <td><input type="text" name="shop_name"></td>
            </tr>
            <tr>
                <th>店舗の写真</th>
                <td><input type="file" name="document" class="form-control"></td>
            </tr>
            <tr>
                <th>都道府県</th>
                <td>
                    <select name="prefecture_id" class="select-prefecture">
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->prefecture_name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>ジャンル</th>
                <td>
                    <select name="genre_id" class="select-genre">
                        @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>店舗概要</th>
                <td><input type="text" name="shop_overview"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit">送信</button></td>
            </tr>
        </table>
    </form>

</div>