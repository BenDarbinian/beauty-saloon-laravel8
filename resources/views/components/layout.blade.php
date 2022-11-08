<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/047ccb3818.js" crossorigin="anonymous"></script>
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <link rel="shortcut icon" href="images/letter-y.png" type="image/png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Ясмин Салон Красоты</title>
</head>

<body>
    <!-- <header class="header" style="background-color: #6b6bb3;">
        <nav class="flex justify-between  navbar header-wrapper">
            <div class="logowords">
                <a class="logoButton" href="/">YASMIN</a>
            </div>
            <div class="nav-icon">
                @auth
                <span class="hello logotext1 mr-4">Добро пожаловать, {{auth()->user()->name}}!</span>
                @endauth
                <a class="logoNavButton"><img class="logoimg2" src="images/menu-button-of-three-horizontal-lines.png"></a>
            </div>
        </nav>
    </header> -->
    <header class="fixed top-0 left-0 z-10 drop-shadow-lg w-full h-16 bg-[#6b6bb3] flex items-center">
        <nav class="px-2 sm:px-2 md:px-4 lg:px-8 xl:px-32 w-full flex justify-between items-center">
            <a href="/" class="font-sans font-bold text-4xl uppercase text-white transition ease hover:scale-110 duration-200">Yasmin</a>
            <div class="flex justify-end">
                <a class="NavButton pr-1 cursor-pointer transition ease hover:scale-110 duration-200"><img class="w-9 h-9 invert" src="images/menu-button-of-three-horizontal-lines.png"></a>
            </div>
        </nav>
    </header>
    <main>
        <!-- <div class="fullScreenNav">
            <div class="backdrop"></div>
            <ul class="navMenu">
                @guest
                <li class="navMenuli"><a class="nav-link navButton" href="register">Регистрация</a></li>
                <li class="navMenuli"><a class="nav-link navButton" href="login">Авторизация</a></li>
                @endguest
                @auth

                <li class="navMenuli"><a class="nav-link navButton" href="account">Личный кабинет</a></li>
                @endauth
                <li class="navMenuli"><a class="nav-link navButton" href="/#map">Найти на карте</a></li>
                <li class="navMenuli"><a class="nav-link navButton" href="/#categories">Услуги</a></li>
                @guest
                <li class="navMenuli"><a class="nav-link navButton" href="/record_guest">Запись на услуги</a></li>
                @endguest
                @auth
                <li class="navMenuli"><a class="nav-link navButton" href="record">Запись на услуги</a></li>
                <li class="navMenuli">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="header-wrapper navButton w-100" style="color: white;">Выйти</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div> -->
        <div class="fullScreenNav">
            <div class="backdrop"></div>
            <ul class="navMenu fixed z-20">
                @guest
                <li class="flex"><a class="text-center mb-3 w-[360px] px-6 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="register">РЕГИСТРАЦИЯ</a></li>

                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="login">АВТОРИЗАЦИЯ</a></li>
                @endguest
                @auth
                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="account">ЛИЧНЫЙ КАБИНЕТ</a></li>
                @endauth
                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="/#map">ПОИСК НА КАРТЕ</a></li>
                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="/#categories">КАТЕГОРИИ</a></li>
                @guest
                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="/record_guest">ЗАПИСЬ</a></li>
                @endguest
                @auth
                <li class="flex"><a class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase" href="record">ЗАПИСЬ</a></li>
                <li class="w-[360px] text-center mb-3 border-4 border-white hover:border-[#bde7f5] rounded-lg hover:text-[#bde7f5] text-white text-4xl uppercase">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:text-[#bde7f5] text-4xl uppercase w-full">Выйти</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
        <div class="h-full">
            {{$slot}}
        </div>

        @if (session()->has('success'))

        <script>
            let a = "{{session('success')}}"
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: a,
                showConfirmButton: false,
                timer: 5000
            })
        </script>
        @endif
    </main>
    <footer class="text-center text-white bg-[#b6b6ff]">
        <div class="mb-4 pt-4">
            <a class="m-1 mr-2" href="https://vk.com/yasmin_club" role="button"><i class="fab fa-vk" style="font-size: 25px"></i></a>

            <a class="m-1 mr-2" href="https://t.me/BenDarbinian" role="button"><i class="fa-brands fa-telegram" style="font-size: 25px"></i></a>

            <a class="m-1 mr-2" href="https://wa.me/+79616104838" role="button"><i class="fa-brands fa-whatsapp" style="font-size: 25px"></i></a>


            <a class="m-1 mr-2" href="https://spb.zoon.ru/beauty/salon_krasoty_yasmin_na_leninskom_prospekte/" role="button"><i class="fa-solid fa-o" style="font-size: 25px"></i></a>
            <a class="m-1 mr-2" href="https://yandex.ru/maps/-/CCUJyKxcKB" role="button"><i class="fa-brands fa-yandex-international" style="font-size: 25px"></i></a>

            <a class="m-1 mr-2" href="https://go.2gis.com/so2pn" role="button"><i class="fa-solid fa-location-dot" style="font-size: 25px"></i></a>

            <section class="pt-3 flex flex-row justify-center">
                <p class="m-1">+7 (961) 610-48-38</p>

                <p class="m-1">yasminbeauty@gmail.com</p>
            </section>

            <section class="mb-1">
                <p>
                    Все предложения и цены, указанные на сайте, носят информационный характер и не являются публичной офертой.
                </p>
            </section>
        </div>
        <div class="text-center text-white p-4 bg-[#6b6bb3]">
            © 2022 Copyright:
            YasminBeauty.com
        </div>
    </footer>
    <script src="script.js"></script>
    <!--

        <div class="container p-4">
        <section class="mb-4">

                <a class="btn btn-outline-light btn-floating m-1" href="https://vk.com/yasmin_club" role="button"><i class="fab fa-vk"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://t-do.ru/@BenDarbinian" role="button"><i class="fa-brands fa-telegram"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://wa.me/+79616104838" role="button"><i class="fa-brands fa-whatsapp"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="https://spb.zoon.ru/beauty/salon_krasoty_yasmin_na_leninskom_prospekte/" role="button"><i class="fa-solid fa-o"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://yandex.ru/maps/-/CCUJyKxcKB" role="button"><i class="fa-brands fa-yandex-international"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://go.2gis.com/so2pn" role="button"><i class="fa-solid fa-location-dot"></i></a>

                <p class="btn btn-floating m-1">+7 (961) 610-48-38</p>

                <p class="btn btn-floating m-1">yasminbeauty@gmail.com</p>
            </section>

            <section class="mb-4">

                <p>
                    Все предложения и цены, указанные на сайте, носят информационный характер и не являются публичной офертой.
                </p>
            </section>

        </div>

        <div class="text-center p-3" style="background-color: #6b6bb3;">
            © 2022 Copyright:
            YasminBeauty.com
        </div>
-->
</body>

</html>