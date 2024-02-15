<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<header class="header">
    <h1 class="header-ttl">
        <a href="index.html">
            Rese
        </a>
    </h1>
    <nav class="header-nav">
        <div class="container mt-3">
            <!-- <div class="search-container"> -->

            <!-- Areaのセレクトボックス -->
            <div class="select-box">
                <!-- <select class="form-control"> -->
                <form class="form-control" action="/search" method="get">
                    @csrf
                    <select class="form_control" name="prefecture_id">
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture['id'] }}">{{ $prefecture['prefecture_name'] }}</option>
                        @endforeach
                    </select>
            </div>

            <!-- グレーの区切り線 -->
            <div class="separator"></div>

            <!-- Genreのセレクトボックス -->
            <div class="select-box">
                <!-- <select class="form-control"> -->
                <form class="form-control" action="/search" method="get">
                    @csrf
                    <select class="form__control" name="genre_id">
                        @foreach ($genres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                        @endforeach
                    </select>
            </div>

            <!-- グレーの区切り線 -->
            <div class="separator"></div>

            <!-- 検索欄 -->
            <div class="search-box">
                <i class="search-icon fas fa-search"></i>

                <input type="text" class="form-control" placeholder="Search ...">
            </div>
            <!-- </div> -->
        </div>
    </nav>
</header>


<div class="shop__all">












    <div class="flex__item">
        <!------------------ 1行目 ----------------------->
        @foreach ($shops as $shop)
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        @endforeach

        <!------- 牛助 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>


        <!------- 戰慄 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- ルーク ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>


        <!------------------ 2行目 ----------------------->
        <!------- 志摩屋 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 香 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>


        <!------- JJ ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>


        <!------- らーめん極み ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------------------ 3行目 ----------------------->
        <!------- 鳥雨 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 築地色合 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 晴海 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 三子 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------------------ 4行目 ----------------------->
        <!------- 八戒 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 福助 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- ラー北 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 翔 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------------------ 5行目 ----------------------->
        <!------- 経緯 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 漆 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- THE TOOL ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>

        <!------- 木船 ------->
        <div class="shop__card">
            <div class="card__img">
                <img src="{{ asset('img/' . $shop->shop_image) }}" alt="" />
            </div>
            <div class="card__content">
                <div class="card__cat">{{ $shop->shop_name }}</div>
                <p class="card__ttl">
                    #{{ $shop->prefecture->prefecture_name }}
                    #{{ $shop->genre->genre_name }}
                </p>
                <div class="tag">
                    <a class="card__tag" href="{{ url('/detail/' . $shop->slug) }}">詳しく見る</a>
                    <p><i class="fas fa-heart" style="color: #EEEEEE; font-size: 5vh;"></i></p>
                </div>
            </div>
        </div>



    </div>
</div>