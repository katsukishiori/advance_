<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/update_shops.css') }}">
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
        <a class="header-nav__btn" href="/create_shops">店舗作成画面へ</a>
    </nav>
</header>

<div class="update_shops">
    <div class="update_shop-ttl">
        <h1>店舗更新</h1>
    </div>

    @if(session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif

    <form action="{{ route('update_shops.update', $shop->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        <table class="update_shops-table">
            <tr>
                <th>店舗名</th>
                <td><input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}"></td>
            </tr>
            <tr>
                <th>店舗の写真</th>
                <td>
                    <img class="update__shop-image" src="{{ asset('storage/images/' . $shop->shop_image) }}" alt="店舗の写真">
                    <input type="file" name="document" class="form-control">
                </td>
            </tr>
            <tr>
                <th>都道府県</th>
                <td>
                    <select name="prefecture" class="form-control">
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" {{ $shop->prefecture->prefecture_name == $prefecture->prefecture_name ? 'selected' : '' }}>
                            {{ $prefecture->prefecture_name }}
                        </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>ジャンル</th>
                <td>
                    <select name="genre" class="form-control">
                        @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $shop->genre->genre_name == $genre->genre_name ? 'selected' : '' }}>
                            {{ $genre->genre_name }}
                        </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>店舗概要</th>
                <td>
                    <textarea name="shop_overview" cols="70" rows="5">{{ $shop->shop_overview }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan=" 2" style="text-align: center;"><button type="submit">送信</button></td>
            </tr>
        </table>



</div>