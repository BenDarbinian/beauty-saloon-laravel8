<x-layout>
    <section class="backgroundNav">
        <div class="tprntWhite">
            <div class="wrapper">
                <div class="nameFirstPage">
                    <h1 class="fPName">САЛОН YASMIN BEAUTY</h1>
                    <div class="fPP">
                        <p class="fPAdress">Ленинский проспект 129, Санкт-Петербург</p>
                        <p class="fPTime">Понедельник–пятница: 9:00–20:00<br> Суббота–воскресенье: 11:00–20:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div id='categories' class="servicesName">
            <h1 class="name1">УСЛУГИ</h1>
        </div>
    </section>

    <section class="services wrapper">
        <div class="container">
            <div class="cards">
                @foreach ($categories as $category)
                <a href="#{{$category->slug}}">
                    <div style="background-image: url(./images/{{$category->slug}}.jpg);">
                        <h1 class="name1">{{$category->name}}</h1>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <section id='services' class="sevices">
        @foreach ($categories as $category)
        <div class="servicesName">
            <h1 id='{{$category -> slug}}' class="name1">{{$category -> name}}</h1>
        </div>
        <div class="tablos">
            <table class="container priceList">
                <tr>
                    <th class="nameLine">Наименование услуги</th>
                    <th class="nameLine">Цена</th>
                </tr>
                @foreach ($services->where('category_id', $category->id) as $service)
                <tr class="Line">
                    <td>
                        <p>{{$service -> name}}</p>
                    </td>
                    <td>
                        <p>{{$service -> price}} руб</p>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        @endforeach
    </section>
    <div id='mapName' class="servicesName">
        <h1 class="name1">Карта</h1>
    </div>
    <div id="map" class="map">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Afd6260b368aa2db65983ca58b636d9307365dd5c11ce139c42ac44dc60316bb0&amp;width=100%25&amp;height=720&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>

</x-layout>