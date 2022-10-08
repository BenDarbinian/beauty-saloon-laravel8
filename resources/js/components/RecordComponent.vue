<template>
    <v-main style="background-color: #b6b6ff">
        <v-card class="mx-auto mt-5" max-width="900">
            <v-toolbar flat color="#6b6bb3" dark>
                <v-toolbar-title>Выбор услуг</v-toolbar-title>
            </v-toolbar>
            <v-sheet class="d-flex justify-center py-1 px-1">
                <v-chip-group column mandatory v-model="checkedCat" active-class="deep-purple--text text--accent-4">
                    <v-chip v-for="category in categories" :key="category.id" :id="category.id" :value="category.id">
                        {{ category.name }}
                    </v-chip>
                </v-chip-group>
            </v-sheet>
            <v-card-text v-for="category in categories" :key="category.id" v-if="checkedCat === category.id">
                <h2 class="text-h6 mb-2">{{ category.name }}</h2>
                <v-chip-group v-model="formData.checkedNames" active-class="deep-purple--text text--accent-4" column
                    multiple max="5">
                    <v-chip v-for="service in services
                    .filter(
                        (services) =>
                            services.category_id == category.id
                    )
                    .sort(services.price)" outlined :key="service.id" :id="service.id" :value="service.id">
                        {{ service.name }}
                    </v-chip>
                </v-chip-group>
                <v-row justify="space-around">
                    <v-col class="flex" xs="12" sm="6" md="6">
                        <v-date-picker v-model="formData.date" :min="borderDates[0]" class="mx-auto test2"
                            max-width="600" :max="borderDates[1]" :disabled="disDate" locale="ru-RU"
                            color="deep-purple lighten-3"></v-date-picker>
                    </v-col>
                    <v-col xs="12" sm="6" md="6" lg="6">
                        <v-chip-group class="md:mt-5 mt-3 ml-6" v-model="formData.time"
                            active-class="deep-purple--text text--accent-4" column mandatory>
                            <v-chip v-for="i in disTimeRe" :key="i[0].slice(0, 5)" :value="i[0].slice(0, 5)"
                                :disabled="i[1]">{{ i[0].slice(0, 5) }}
                            </v-chip>
                        </v-chip-group>
                    </v-col>
                </v-row>
                <div class="text-center">
                    <v-btn class="ma-2" :disabled="disRec" color="deep-purple--text text--accent-4"
                        @click="CreateRecord()">
                        Записаться
                    </v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-main>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            // переменная хранит данные о записях
            records: [],
            // переменная хранит данные об услугах
            services: [],
            // переменная хранит данные о категориях услуг
            categories: [],
            formData: {
                // переменная хранит массив с id услуг
                checkedNames: [],
                // переменная хранит выбранную дату
                date: null,
                // переменная хренит выбранное время
                time: null,
            },
            // переменная хранит id категории
            checkedCat: 0,
        };
    },
    methods: {
        // сумма начальной даты и общего количества времени предоставления услуг
        timeConverter: function (time, sumTime) {
            let h = 0;
            let m = Number(time.slice(3, 5)) + Number(sumTime);
            if (m >= 60) {
                while (m >= 60) {
                    m -= 60;
                    h += 1;
                }
            }
            h = Number(time.slice(0, 2)) + h;
            return new Date(0, 0, 0, h, m, 0).toTimeString();
        },
        // запись на услуги отправка POST запроса на сервер
        CreateRecord() {
            // отправка об]екта с данными formData, вывод сообщения с сервера, перенаправление на главную страницу
            axios
                .post("/api/records", this.formData)
                .then((data) => {
                    this.$swal
                        .fire({
                            title: "Круто!",
                            text: data.data.message,
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "ОК",
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/";
                            }
                        });
                    // sweetalert
                })
                .catch((err) => {
                    //alert(err.data)
                });
        },
    },
    computed: {
        // расчет для disabled кнопок даты
        disDate: function () {
            // если в массиве выбранных услуг элементов меньше 1, очисить переменную с выбранной датой и вернуть обратное true, иначе false
            return this.formData.checkedNames.length < 1
                ? !(this.formData.date = null)
                : false;
        },
        // расчет для disabled кнопки записи
        disRec: function () {
            // если переменная, хранящая время пустая, вернуть true иначе false
            return this.formData.time == null ? true : false;
        },
        // создание массива с  элементами [время, значение для disabled]
        timeArray: function () {
            let a = [];
            let key;
            for (let h = 11; h <= 19; h++) {
                for (let m = 0; m <= 55; m += 15) {
                    key = new Date(0, 0, 0, h, m, 0).toTimeString();
                    a.push([key.slice(0, 8), false]);
                }
            }
            return a;
        },
        // переключатель кнопок выбора времени
        disTimeRe: function () {
            let a = this.timeArray;
            if (this.formData.date == null) {
                this.formData.time = null;
                a.map((element) => (element[1] = true));
            } else {
                a.map((element) => (element[1] = false));
                if (
                    this.formData.date == new Date().toISOString().slice(0, 10)
                ) {
                    a.map(
                        (element) => {
                            if (element[0].slice(0, 5) < new Date().toLocaleTimeString("en-US", { hour12: false }).slice(0, -3)) {
                                if (this.formData.time == element[0].slice(0, 5)) {
                                    this.formData.time = null;
                                }
                                element[1] = true;
                            }

                        }
                    );
                }
                let recordDateArray = [["20:00:00", 0]];
                for (let record of this.records.filter(
                    (records) => records.date == this.formData.date
                )) {
                    recordDateArray.push([record.time, record.sTime]);
                }
                for (let recordDate of recordDateArray) {
                    for (let element of a.filter(
                        (element) => element[1] == false
                    )) {
                        let elEndTime = this.timeConverter(
                            element[0],
                            this.selectedSerSumTime
                        );
                        if (
                            element[0].slice(0, 5) <=
                            recordDate[0].slice(0, 5) &&
                            elEndTime.slice(0, 5) > recordDate[0].slice(0, 5)
                        ) {
                            if (this.formData.time == element[0].slice(0, 5)) {
                                this.formData.time = null;
                            }
                            element[1] = true;
                        }

                        if (recordDateArray.length > 1) {
                            elEndTime = this.timeConverter(
                                recordDate[0],
                                recordDate[1]
                            );

                            if (
                                element[0].slice(0, 5) <
                                elEndTime.slice(0, 5) &&
                                element[0].slice(0, 5) >
                                recordDate[0].slice(0, 5)
                            ) {
                                if (this.formData.time == element[0].slice(0, 5)) {
                                    this.formData.time = null;
                                }
                                element[1] = true;
                            }
                        }
                    }
                }
            }
            return a;
        },
        // расчет общего количества времени предоставления услуг из списка выбранных
        selectedSerSumTime: function () {
            let result = 0;
            for (let checkedName of this.formData.checkedNames) {
                result += this.services[checkedName - 1].time;
            }
            return result;
        },
        // расчет ограничений выбора дат
        borderDates: function () {
            // нижняя дата сегодняншяя по московскому времени
            let mindate = new Date().toISOString().substr(0, 10);
            // верхняя дата сегодняшняя дата + 15.778.800.000 миллисекунд
            let maxdate = new Date(Date.now() + 15778800000)
                .toISOString()
                .substr(0, 10);
            return [mindate, maxdate];
        },
    },
    // достаем данные из базы
    created() {
        fetch("/api/services")
            .then((response) => response.json())
            .then((services) => {
                this.services = services;
            });
        fetch("/api/records")
            .then((response) => response.json())
            .then((records) => {
                this.records = records.data;
            });
        fetch("/api/categories")
            .then((response) => response.json())
            .then((categories) => {
                this.categories = categories;
            });
    },
};
</script>
