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
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>