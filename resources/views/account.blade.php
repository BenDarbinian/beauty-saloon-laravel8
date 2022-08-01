<x-layout>
    <section class="backgroundNav3 test10">
        <div class="mask d-flex align-items-center gradient-custom-3">
            <div class="container test17">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card test7" style="border-radius: 15px; background-color: #e4f9fed5;">
                            <h1 style="margin-left: 4%; color: #222222;">История Записей</h1>
                            <table class="table table-condensed table-striped test15">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>№</th>
                                        <th>Дата</th>
                                        <th>Время</th>
                                        <th>Общая стоимость</th>
                                        <th>Общее время</th>
                                        <th>Статус</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $n = 1;
                                    $slug = 'a';
                                    @endphp
                                    @foreach ($records->reverse()  as $record)

                                    <tr data-toggle="collapse" data-target="#{{$slug}}" class="accordion-toggle">
                                        <td></td>
                                        <td>{{$n}}</td>
                                        <td>{{$record->date}}</td>
                                        <td>{{$record->time}}</td>
                                        <td>{{$record->Sprice}} рублей</td>
                                        <td>{{$record->Stime}} минут</td>
                                        <td><p class="text-{{$record->Status->bootColor}}">{{$record->Status->name}}</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordian-body collapse" id="{{$slug}}">
                                                <table class="table table-striped test15" style="background-color: #ccccffd5;">
                                                    <thead>
                                                        <tr class="info">
                                                            <th>Название услуги</th>
                                                            <th>Категория</th>
                                                            <th>Цена</th>
                                                            <th>Время</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($serHistories->where('record_id', $record->id) as $serHis)
                                                        <tr class="info">
                                                            <td>{{$serHis->Service->name}}</td>
                                                            <td>{{$serHis->Service->Category->name}}</td>
                                                            <td>{{$serHis->Service->price}} руб</td>
                                                            <td>{{$serHis->Service->time}} минут</td>

                                                        </tr>
                                                        @endforeach
                                                        @php
                                                        $n += 1;
                                                        $slug = 'a' .$n;
                                                        @endphp
                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr> @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>