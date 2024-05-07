<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @yield('css')
</head>

<body>
    <div class="background">
        <header class="header">
            <div class="header__inner">
                <a class="header__logo" href="/">
                    <img src="{{ asset('Group 2.png') }}" alt="ロゴ">
                </a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>