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
                <button class="menu-button hamburger" id="js-menu-button">
                        <span></span>
                        <span></span>
                        <span></span>
                </button>
                <h1 class="header__logo">
                    <a href="/">Rese</a>
                </h1>
                <nav class="header__nav nav" id="js-nav">
                    <ul class="nav__items nav-items">
                        @guest
                            <li class="nav-items__item"><a href="/">Home</a></li>
                            <li class="nav-items__item"><a href="/register">Registration</a></li>
                            <li class="nav-items__item"><a href="/login">Login</a></li>
                        @else
                            <li class="nav-items__item"><a href="/">Home</a></li>
                            <li class="nav-items__item">
                                <form id="logout-form" action="/logout" method="POST">
                                @csrf
                                <button class="nav-items__button">Logout</button>
                                </form>
                            </li>
                            <li class="nav-items__item"><a href="/mypage">Mypage</a></li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <script>
    const ham = document.querySelector('#js-menu-button');
    const nav = document.querySelector('#js-nav');

    ham.addEventListener('click', function () {
        ham.classList.toggle('active');
        nav.classList.toggle('active');
    });

    </script>
</body>

</html>