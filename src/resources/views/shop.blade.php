<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-w22ofWoEaD0QG6Lg5uKsRYbOhAaEN3KIo6p6BkRH9KXjU2VE+D1eg/ggX1Waf3+u" crossorigin="anonymous">

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
                </a>
                <a class="header__logo" href="/">Rese</a>
            </form>

        </div>
    </div>


    <nav class="header-nav">

        <div class="container mt-3">

            <!-- 都道府県のセレクトボックス -->
            <div class="select-box">
                <form class="form-control" action="/search" method="get">
                    @csrf
                    <select class="form-control" name="prefecture_id" id="prefectureArea">
                        <option value="all">All area</option>
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture['id'] }}">{{ $prefecture['prefecture_name'] }}</option>
                        @endforeach
                    </select>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var prefectureSelect = document.getElementById('prefectureArea');

                            prefectureSelect.addEventListener('change', function() {
                                var selectedPrefecture = prefectureSelect.value;

                                // 選択された値が "all" の場合は全都道府県の情報を取得
                                if (selectedPrefecture === 'all') {
                                    console.log('エリア全体が選択されました。全都道府県の情報を取得します。')
                                }
                            });
                        });
                    </script>




                    <!-- ジャンルのセレクトボックス -->
                    <select class="form-control" name="genre_id" id="genreSelect">
                        <option value="all">All genre</option>
                        @foreach ($genres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                        @endforeach
                    </select>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var genreSelect = document.getElementById('genreSelect');

                            genreSelect.addEventListener('change', function() {
                                var selectedGenre = genreSelect.value;

                                // 選択された値が "all" の場合は全ジャンルの情報を取得
                                if (selectedGenre === 'all') {
                                    console.log('ジャンル全体が選択されました。全ジャンルの情報を取得します。')
                                }
                            });
                        });
                    </script>
            </div>

            <!-- グレーの区切り線 -->
            <div class="separator"></div>

            <!-- 検索欄 -->
            <div class="search-box">
                <button type="submit" class="search-icon-btn">
                    <i class="fas fa-search" style="color: #EEEEEE"></i>
                </button>

                <input type="text" class="form-control" name="keyword" placeholder="Search ...">
            </div>

        </div>

    </nav>

</header>


<!------ 店舗カード -------->
<div class="shop__all">
    <div class="flex__item">

        @foreach ($shops as $shop)
        <div class="shop__card">
            <div class="card__img">
                <!-- <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" /> -->
                <img src="{{ asset('storage/images/' . $shop->shop_image) }}" alt="店舗画像">
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>

                <!-- ５段階評価星マーク -->
                <div id="rating">
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fas fa-comment-dots" style="cursor: pointer;" onclick="redirectToEvaluation()"></i>
                </div>

                <script>
                    function redirectToEvaluation() {
                        // JavaScriptで評価ページにリダイレクト
                        window.location.href = "/detail/" + slug;
                    }
                </script>

                <script>
                    $('.fa').on('mouseover', function() {
                        var $this = $(this);
                        $this.nextAll().removeClass('fa-star').addClass("fa-star-o");
                        $this.prevAll().removeClass("fa-star-o").addClass('fa-star');
                        $this.removeClass("fa-star-o").addClass('fa-star');
                    });
                    $('.fa').one('click', function() {
                        var $this = $(this);
                        $this.addClass('active').siblings().removeClass('active');
                    });
                    $('.fa').on('mouseleave', function() {
                        var select = $('.active');
                        select.nextAll().removeClass('fa-star').addClass('fa-star-o');
                        select.prevAll().removeClass('fa-star-o').addClass('fa-star');
                        select.removeClass('fa-star-o').addClass('fa-star');
                    });
                </script>


                <div class="tag">
                    <a class="card__tag" href="{{ route('index', ['shop_id' => $shop->id]) }}">詳しく見る</a>

                    <!-- お気に入りボタン -->
                    <a href="{{ route('mypage', $shop->id) }}" class="btn btn-primary" onclick="toggleFavorite(event, '{{ $shop->id }}')">
                        <i id="heartIcon{{ $shop->id }}" class="fas fa-heart" style="color: {{ $shop->is_favorite ? 'red' : '#EEEEEE' }}; font-size: 30px;"></i>
                    </a>


                    <!-- ハートの色を変える -->
                    <script>
                        async function toggleFavorite(event, shopId) {
                            event.preventDefault();

                            var heartIcon = document.getElementById('heartIcon' + shopId);

                            if (heartIcon.style.color === 'red') {
                                heartIcon.style.color = '#EEEEEE';
                                await sendFavoriteStatusToServer(shopId, false);
                            } else {
                                heartIcon.style.color = 'red';
                                await sendFavoriteStatusToServer(shopId, true);
                            }
                        }

                        async function sendFavoriteStatusToServer(shopId, isFavorite) {
                            try {
                                const response = await fetch('/favorites/add', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({
                                        shopId: shopId,
                                        isFavorite: isFavorite,
                                    }),
                                });

                                if (response.ok) {
                                    console.log('お気に入りの状態がサーバーに送信されました');
                                } else {
                                    console.error('お気に入りの状態の送信に失敗しました');
                                }
                            } catch (error) {
                                console.error('エラーが発生しました', error);
                            }
                        }
                    </script>



                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>