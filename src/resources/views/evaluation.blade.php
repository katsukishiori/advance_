<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation</title>

    <link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>


    <div class="shop-title">
        <button onclick="goBack()" class="return-btn">×</button>
    </div>

    <script>
        function goBack() {
            // ブラウザの履歴を1つ前に戻る
            window.history.back();
        }
    </script>

    <form class="form" action="{{ route('evaluation.store') }}" method="post">
        @csrf
        <div class="evaluation-ttl">
            <h2>{{ $shopData->shop_name }}</h2>
        </div>

        <div class="nickname">
            <h2>ニックネーム</h2>
            <input type="text" name="nickname" />
        </div>

        <div class="star-rating">
            <h2>評価</h2>

            <div class="rating-container">
                <div id="rating">
                    <i class="fas fa-star" data-index="1"></i>
                    <i class="fas fa-star" data-index="2"></i>
                    <i class="fas fa-star" data-index="3"></i>
                    <i class="fas fa-star" data-index="4"></i>
                    <i class="fas fa-star" data-index="5"></i>
                </div>



                <select id="ratingSelect" name="rating" onchange="updateRating()">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

                <script>
                    const stars = document.querySelectorAll('#rating i');
                    const ratingSelect = document.getElementById('ratingSelect');

                    ratingSelect.addEventListener('change', updateRating);

                    function updateRating() {
                        const selectedRating = parseInt(ratingSelect.value);

                        // 星の評価を設定
                        setRating(selectedRating);

                        // ここで評価をサーバーに送信する処理を追加
                        sendRatingToServer(selectedRating);
                    }

                    function setRating(index) {
                        stars.forEach((star, i) => {
                            star.classList.toggle('active', i < index);
                        });
                    }

                    function sendRatingToServer(index) {
                        // ここにAjaxなどを使用してサーバーに評価を送信する処理を追加
                        console.log('Rating sent to server:', index);
                    }
                </script>

            </div>

        </div>



        <div class="comment">
            <h2>コメント</h2>

            <form action="/evaluation" method="get">
                <textarea name="textarea" cols="50" rows="7"></textarea>

                <!-- shop_id を送るための隠しフィールド -->
                <input type="hidden" name="shop_id" value="{{ request('shop_id') }}">

                <div class="form__button">
                    <button class="form__button-submit" type="submit">口コミを投稿する</button>
                </div>

            </form>

</body>