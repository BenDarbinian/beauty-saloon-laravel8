<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=KEY_SITE_V3"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="images/letter-y.png" type="image/png">
    <link rel="stylesheet" href="styles.css" />
    <title>Ясмин Салон Красоты</title>
</head>

<body>
    <header class="header" style="background-color: #6b6bb3;">
        <nav class="navbar header-wrapper">
            <div class="logowords">
                <a class="navbar-brand logoButton" href="/"><span class="logotext">YASMIN</span></a>
            </div>
            <div class="align-items-baseline flex-row nav-icon">
                @auth
                <span class="hello logotext1 mr-4">Добро пожаловать, {{auth()->user()->name}}!</span>
                @endauth
                <a class="navbar-brand logoNavButton"><img class="logoimg2" src="images/menu-button-of-three-horizontal-lines.png"></a>
            </div>
        </nav>
    </header>
    <main>
        <div class="fullScreenNav">
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
        </div>
        <div class="test7">
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

        <!--{{session('success')}}-->
        @endif
    </main>
    <script src="./js/app.js"></script>
    <script src="script.js"></script>
    <!-- Footer -->
    <footer class="text-center text-white footer" style="background-color: #b6b6ff;">
        <!-- Grid container -->
        <div class="container p-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://vk.com/yasmin_club" role="button"><i class="fab fa-vk"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://t-do.ru/@BenDarbinian" role="button"><i class="fa-brands fa-telegram"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://wa.me/+79616104838" role="button"><i class="fa-brands fa-whatsapp"></i></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://spb.zoon.ru/beauty/salon_krasoty_yasmin_na_leninskom_prospekte/" role="button"><i class="fa-solid fa-o"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://yandex.ru/maps/-/CCUJyKxcKB" role="button"><i class="fa-brands fa-yandex-international"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://go.2gis.com/so2pn" role="button"><i class="fa-solid fa-location-dot"></i></a>

                <p class="btn btn-floating m-1">+7 (961) 610-48-38</p>

                <p class="btn btn-floating m-1">yasminbeauty@gmail.com</p>
            </section>
            <!-- Section: Social media -->
            <!-- Section: Text -->
            <section class="mb-4">

                <p>
                    Все предложения и цены, указанные на сайте, носят информационный характер и не являются публичной офертой.
                </p>
            </section>
            <!-- Section: Text -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #6b6bb3;">
            © 2022 Copyright:
            YasminBeauty.com
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>