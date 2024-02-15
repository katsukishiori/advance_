<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    Rese
                </a>
                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/mypage">マイページ</a>
                        </li>
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        @endif

                        @if(Request::is('shop'))
                        <!-- /shopにアクセス中の場合の追加ナビゲーション -->
                        <li class="header-nav__item">
                            <div class="container mt-3">
                                <div class="search-container">
                                    <!-- Areaのセレクトボックス -->
                                    <div class="select-box">
                                        <select class="form-control">
                                            <option value="">All area</option>
                                            <option value="area1">エリア1</option>
                                            <option value="area2">エリア2</option>
                                            <!-- 他のオプションを追加 -->
                                        </select>
                                    </div>

                                    <!-- グレーの区切り線 -->
                                    <div class="separator"></div>

                                    <!-- Genreのセレクトボックス -->
                                    <div class="select-box">
                                        <select class="form-control">
                                            <option value="">All genre</option>
                                            <option value="genre1">ジャンル1</option>
                                            <option value="genre2">ジャンル2</option>
                                            <!-- 他のオプションを追加 -->
                                        </select>
                                    </div>

                                    <!-- グレーの区切り線 -->
                                    <div class="separator"></div>

                                    <!-- 検索欄 -->
                                    <div class="search-box">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                    </div>

                                    <!-- 任意の検索ボタンなどを追加できます -->
                                    <!-- <button class="btn btn-primary ml-2">検索</button> -->
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>