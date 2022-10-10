<x-layout>
    <section class="backgroundNav">
        <div class="relative bg-white/50 text-right top-[66%] pb-[2px] pr-10 sm:pr-15 md:pr-25 lg:pr-40 xl:pr-80">
            <div class="h-full">
                <div class="flex flex-col flex-wrap font-sans text-[#111827]">
                    <h1 class=" font-light text-4xl sm:text-5xl lg:text-6xl xl:text-7xl">САЛОН YASMIN BEAUTY</h1>
                    <div class="text-base sm:text-lg lg:text-xl xl:text-2xl">
                        <p>Ленинский проспект 129, Санкт-Петербург</p>
                        <p>Понедельник–пятница: 10:00–20:00<br> Суббота–воскресенье: 11:00–20:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div id='categories' class="flex justify-center items-center h-10 sm:h-14 md:h-16 bg-[#b6b6ff] m-0">
            <h1 class="font-sans font-light text-center text-3xl sm:text-4xl md:text-5xl uppercase">УСЛУГИ</h1>
        </div>
    </section>

    <section class="category backgroundNav3 h-full pt-10 pb-0 sm:pb-5 px-2 sm:px-15 md:px-30 lg:px-50 xl:px-72">
        <div class="flex flex-wrap flex-row justify-center gap-3 sm:gap-8">
            @foreach ($categories as $category)
            <a href="#{{$category->slug}}" class="z-[9]">
                <div class="flex items-end justify-center rounded-[10%] w-44 h-40 sm:w-60 lg:w-80 sm:h-52 lg:h-72 opacity-[.85] bg-cover overflow-hidden transition ease hover:scale-110 hover:opacity-100 duration-200" style="background-image: url(../images/{{$category->slug}}.jpg);">
                    <h1 class="font-sans font-light text-3xl sm:text-4xl text-[#1d283f] text-center bg-white/50 w-full py-2 uppercase">{{$category->name}}</h1>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    <section id='services' class="bg-[#bde7f5] bg-cover h-full">
        <!-- @foreach ($categories as $category)
        <div class="category backgroundNav3 flex flex-col justify-center py-10">
            <h1 id='{{$category -> slug}}' class="text-3xl sm:text-4xl md:text-5xl text-center font-light py-3 uppercase">{{$category -> name}}</h1>
            <table class="font-sans mx-0 sm:mx-10 md:mx-15 lg:mx-20 xl:mx-40">
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
        @endforeach -->
        @foreach ($categories as $category)
        <div class="category backgroundNav3 flex flex-col justify-center py-3 sm:py-5 md:py-7">
            <h1 id='{{$category -> slug}}' class="text-3xl sm:text-4xl md:text-5xl text-center font-light py-3 uppercase">{{$category -> name}}</h1>
            <div class="table font-sans mx-2 sm:mx-10 md:mx-15 lg:mx-20 xl:mx-40 z-[9]">
                <div class="table-header-group">
                    <div class="table-row">
                        <div class="table-cell w-[70%] text-xl sm:text-2xl md:text-3xl bg-[#ccccff] p-3 text-center">Наименование услуги</div>
                        <div class="table-cell text-xl sm:text-2xl md:text-3xl bg-[#ccccff] p-3 text-center">Цена</div>
                    </div>
                </div>
                @foreach ($services->where('category_id', $category->id) as $service)
                <div class="table-row-group font-extralight opacity-[.85] text-3xl text-[#1d283f] odd:bg-[#e0f5ff] even:bg-[#fbfeff]">
                    <div class="table-row">
                        <div class="table-cell py-3">
                            <p class="text-xl sm:text-2xl md:text-3xl pl-2 sm:pl-5 md:pl-10">{{$service -> name}}</p>
                        </div>
                        <div class="table-cell py-3">
                            <p class="text-xl sm:text-2xl md:text-3xl pl-2 sm:pl-5 md:pl-10">{{$service -> price}} руб</p>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>
    <div id='mapName' class="flex justify-center items-center h-10 sm:h-14 md:h-16 bg-[#b6b6ff] m-0 ">
        <h1 class="font-sans font-light text-center text-3xl sm:text-4xl md:text-5xl uppercase">Карта</h1>
    </div>
    <div id="map" class="map backgroundNav3">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Afd6260b368aa2db65983ca58b636d9307365dd5c11ce139c42ac44dc60316bb0&amp;width=100%25&amp;height=720&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>

</x-layout>