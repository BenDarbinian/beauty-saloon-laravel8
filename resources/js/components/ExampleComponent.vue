<template>
    <v-app class="test10" style="background-color: #bde7f5">
        <div class="backgroundNav3">
            <v-card class="mx-auto test" max-width="1280">
                <v-toolbar flat color="deep-purple lighten-3" dark>
                    <v-toolbar-title>Записи</v-toolbar-title>
                </v-toolbar>
                <v-sheet class="d-flex justify-center py-1 px-1">
                    <v-chip-group
                        mandatory
                        v-model="checkedGuestAuth"
                        active-class="deep-purple--text text--accent-4"
                    >
                        <v-chip key="1" id="1" value="1"> Гости </v-chip>
                        <v-chip key="2" id="2" value="2">
                            Авторизованные пользователи
                        </v-chip>
                    </v-chip-group>
                </v-sheet>
                <v-card-text v-show="checkedGuestAuth == 1">
                    <v-sheet class="d-flex justify-center">
                        <v-chip-group
                            mandatory
                            v-model="checkedStatus"
                            active-class="deep-purple--text text--accent-4"
                        >
                            <v-chip
                                v-for="status in statuses"
                                :key="status.id"
                                :id="status.id"
                                :value="status.id"
                                >{{ status.name }}</v-chip
                            >
                        </v-chip-group>
                    </v-sheet>
                    <div calss="d-flex" v-if="formData.guestRec != 0">
                        <v-card class="mx-auto" max-width="1024">
                            <v-toolbar flat color="deep-purple lighten-3" dark>
                                <template class="d-flex">
                                    <v-toolbar-title
                                        >Выбор услуг</v-toolbar-title
                                    >
                                    <v-btn
                                        class="ml-auto ma-1"
                                        outlined
                                        fab
                                        x-small
                                        color="danger"
                                        v-on:click="closeBoard()"
                                    >
                                        <i class="fa-solid fa-xmark"></i>
                                    </v-btn>
                                </template>
                            </v-toolbar>
                            <v-sheet class="d-flex justify-center py-1 px-1">
                                <v-chip-group
                                    mandatory
                                    v-model="checkedCat"
                                    active-class="deep-purple--text text--accent-4"
                                >
                                    <v-chip
                                        v-for="category in categories"
                                        :key="category.id"
                                        :id="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </v-chip>
                                </v-chip-group>
                            </v-sheet>
                            <v-card-text
                                v-for="category in categories"
                                :key="category.id"
                                v-if="checkedCat === category.id"
                            >
                                <h2 class="text-h6 mb-2">
                                    {{ category.name }}
                                </h2>

                                <v-chip-group
                                    v-model="formData.checkedNames"
                                    active-class="deep-purple--text text--accent-4"
                                    column
                                    multiple
                                    max="5"
                                >
                                    <v-chip
                                        v-for="service in services
                                            .filter(
                                                (services) =>
                                                    services.category_id ==
                                                    category.id
                                            )
                                            .sort(services.price)"
                                        outlined
                                        :key="service.id"
                                        :id="service.id"
                                        :value="service.id"
                                    >
                                        {{ service.name }}
                                    </v-chip>
                                </v-chip-group>
                                <v-row justify="space-around">
                                    <v-col>
                                        <v-date-picker
                                            v-model="formData.date"
                                            :min="mindate"
                                            class="mx-auto test2"
                                            max-width="600"
                                            :max="maxdate"
                                            :disabled="disDate()"
                                            landscape
                                            locale="ru-RU"
                                            color="deep-purple lighten-3"
                                        ></v-date-picker>
                                    </v-col>
                                    <v-col>
                                        <v-chip-group
                                            class="test2 test3"
                                            v-model="formData.time"
                                            active-class="deep-purple--text text--accent-4"
                                            column
                                            mandatory
                                        >
                                            <v-chip
                                                v-for="i in Timebuttons"
                                                :key="i.slice(0, 5)"
                                                :value="i.slice(0, 5)"
                                                :disabled="disTime(i)"
                                                >{{ i.slice(0, 5) }}
                                            </v-chip>
                                        </v-chip-group>
                                    </v-col>
                                </v-row>
                                <div class="text-center">
                                    <v-btn
                                        class="ma-2"
                                        :disabled="disRec()"
                                        color="deep-purple--text text--accent-4"
                                        @click="CreateRecord()"
                                    >
                                        Запись
                                    </v-btn>
                                </div>
                            </v-card-text>
                        </v-card>
                    </div>
                    <table class="table table-condensed table-striped test15">
                        <thead v-if="checkedStatus == 1 || checkedStatus == 4">
                            <tr>
                                <th></th>
                                <th>Имя</th>
                                <th>Номер телефона</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-for="status in statuses">
                            <template
                                v-for="recordg in recordgs
                                    .filter(
                                        (recordgs) =>
                                            recordgs.status_id == status.id
                                    )
                                    .reverse()"
                            >
                                <tr
                                    v-if="
                                        checkedStatus == status.id &&
                                        status.id != 2 &&
                                        status.id != 3
                                    "
                                >
                                    <td></td>
                                    <td>{{ recordg.name }}</td>
                                    <td>{{ recordg.phone_number }}</td>
                                    <td
                                        :class="
                                            statusColor(
                                                recordg.status.bootColor
                                            )
                                        "
                                    >
                                        {{ recordg.status.name }}
                                    </td>
                                    <td
                                        v-if="status.id == 1 || status.id == 2"
                                        class="d-flex"
                                    >
                                        <v-btn
                                            class="ma-1"
                                            outlined
                                            fab
                                            x-small
                                            color="primary"
                                            :key="recordg.id"
                                            :id="recordg.id"
                                            v-on:click="
                                                openBoard(
                                                    recordg.id,
                                                    recordg.name,
                                                    recordg.phone_number
                                                )
                                            "
                                        >
                                            <i
                                                class="fa-solid fa-circle-check"
                                            ></i>
                                        </v-btn>
                                        <v-btn
                                            class="ma-1"
                                            outlined
                                            fab
                                            x-small
                                            color="red"
                                            :key="disKey(recordg.id)"
                                            :id="recordg.id"
                                            v-on:click="guestCencel(recordg.id)"
                                        >
                                            <i class="fa-solid fa-xmark"></i>
                                        </v-btn>
                                    </td>
                                    <td></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <table class="table table-condensed table-striped test15">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Имя</th>
                                <th>Номер</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Общая стоимость</th>
                                <th>Общее время</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-for="status in statuses">
                            <template
                                v-for="record in recordsstatus
                                    .filter(
                                        (recordsstatus) =>
                                            recordsstatus.status_id ==
                                                status.id &&
                                            recordsstatus.user_id == null
                                    )
                                    .reverse()"
                            >
                                <tr
                                    data-toggle="collapse"
                                    :data-target="record.id"
                                    class="accordion-toggle"
                                    v-if="checkedStatus == status.id"
                                >
                                    <td></td>
                                    <td>{{ record.name }}</td>
                                    <td>{{ record.phone_number }}</td>
                                    <td>{{ record.date }}</td>
                                    <td>{{ record.time }}</td>
                                    <td>{{ record.sPrice }} рублей</td>
                                    <td>{{ record.sTime }} минут</td>
                                    <td
                                        :class="
                                            statusColor(record.status.bootColor)
                                        "
                                    >
                                        {{ record.status.name }}
                                    </td>
                                    <td
                                        v-if="status.id == 1 || status.id == 2"
                                        class="d-flex"
                                    >
                                        <template v-if="status.id == 1">
                                            <v-btn
                                                class="ma-1"
                                                outlined
                                                fab
                                                x-small
                                                color="blue"
                                                value="Подтверждена"
                                                :key="record.id"
                                                :id="record.id"
                                                v-on:click="
                                                    recording(
                                                        2,
                                                        'Подтверждена',
                                                        record.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa-solid fa-circle-check"
                                                ></i>
                                            </v-btn>
                                        </template>
                                        <template v-if="status.id == 2">
                                            <v-btn
                                                class="ma-1"
                                                outlined
                                                fab
                                                x-small
                                                color="green"
                                                value="Проведена"
                                                :key="record.id"
                                                :id="record.id"
                                                v-on:click="
                                                    recording(
                                                        3,
                                                        'Проведена',
                                                        record.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa-solid fa-circle-check"
                                                ></i>
                                            </v-btn>
                                        </template>
                                        <v-btn
                                            class="ma-1"
                                            outlined
                                            fab
                                            x-small
                                            color="red"
                                            value="Отменена"
                                            :key="disKey(record.id)"
                                            :id="record.id"
                                            v-on:click="
                                                recording(
                                                    4,
                                                    'Отменена',
                                                    record.id
                                                )
                                            "
                                        >
                                            <i class="fa-solid fa-xmark"></i>
                                        </v-btn>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </v-card-text>
                <v-card-text v-if="checkedGuestAuth == 2">
                    <v-sheet class="d-flex justify-center">
                        <v-chip-group
                            mandatory
                            v-model="checkedStatus"
                            active-class="deep-purple--text text--accent-4"
                        >
                            <v-chip
                                v-for="status in statuses"
                                :key="status.id"
                                :id="status.id"
                                :value="status.id"
                                >{{ status.name }}</v-chip
                            >
                        </v-chip-group>
                    </v-sheet>
                    <table class="table table-condensed table-striped test15">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Имя</th>
                                <th>Номер</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Общая стоимость</th>
                                <th>Общее время</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-for="status in statuses">
                            <template
                                v-for="record in recordsstatus
                                    .filter(
                                        (recordsstatus) =>
                                            (recordsstatus.status_id ==
                                                status.id &&
                                            recordsstatus.user_id != null)
                                    )
                                    .reverse()"
                            >
                                <tr
                                    data-toggle="collapse"
                                    :data-target="record.id"
                                    class="accordion-toggle"
                                    v-if="checkedStatus == status.id"
                                >
                                    <td></td>
                                    <td>{{ record.name }}</td>
                                    <td>{{ record.phone_number }}</td>
                                    <td>{{ record.date }}</td>
                                    <td>{{ record.time }}</td>
                                    <td>{{ record.sPrice }} рублей</td>
                                    <td>{{ record.sTime }} минут</td>
                                    <td
                                        :class="
                                            statusColor(record.status.bootColor)
                                        "
                                    >
                                        {{ record.status.name }}
                                    </td>
                                    <td
                                        v-if="status.id == 1 || status.id == 2"
                                        class="d-flex"
                                    >
                                        <template v-if="status.id == 1">
                                            <v-btn
                                                class="ma-1"
                                                outlined
                                                fab
                                                x-small
                                                color="blue"
                                                value="Подтверждена"
                                                :key="record.id"
                                                :id="record.id"
                                                v-on:click="
                                                    recording(
                                                        2,
                                                        'Подтверждена',
                                                        record.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa-solid fa-circle-check"
                                                ></i>
                                            </v-btn>
                                        </template>
                                        <template v-if="status.id == 2">
                                            <v-btn
                                                class="ma-1"
                                                outlined
                                                fab
                                                x-small
                                                color="green"
                                                value="Проведена"
                                                :key="record.id"
                                                :id="record.id"
                                                v-on:click="
                                                    recording(
                                                        3,
                                                        'Проведена',
                                                        record.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa-solid fa-circle-check"
                                                ></i>
                                            </v-btn>
                                        </template>
                                        <v-btn
                                            class="ma-1"
                                            outlined
                                            fab
                                            x-small
                                            color="red"
                                            value="Отменена"
                                            :key="disKey(record.id)"
                                            :id="record.id"
                                            v-on:click="
                                                recording(
                                                    4,
                                                    'Отменена',
                                                    record.id
                                                )
                                            "
                                        >
                                            <i class="fa-solid fa-xmark"></i>
                                        </v-btn>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </v-card-text>
            </v-card>
        </div>
    </v-app>
</template>
<script>
// import axios from "axios";
export default {
    data() {
        return {
            formData: {
                checkedNames: [],
                date: null,
                time: null,
                phone_number: null,
                name: null,
                guestRec: 0,
            },
            checkedCat: 0,
            mindate: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
            maxdate: new Date(Date.now() + 20000000000)
                .toISOString()
                .substr(0, 10),
            btnType: null,
            checkedGuestAuth: 0,
            n: "c",
            checkedStatus: 0,
            recordsstatus: [],
            services: [],
            categories: [],
            recordgs: [],
            statuses: [],
            servicehistory: [],
        };
    },
    methods: {
        disDate: function () {
            if (this.formData.checkedNames.length < 1) {
                this.formData.date = null;
                return true;
            } else false;
        },
        disTime: function (i) {
            if (this.formData.date == null) {
                this.formData.time = null;
                return true;
            } else false;
            if (this.formData.date == new Date().toISOString().slice(0, 10)) {
                if (
                    i.slice(0, 5) < new Date().toLocaleTimeString().slice(0, -3)
                ) {
                    if (this.formData.time == i.slice(0, 5)) {
                        this.formData.time = null;
                    }
                    return true;
                }
            }
            let sum = 0;
            for (let checkedName of this.formData.checkedNames) {
                for (let service of this.services) {
                    if (service.id == checkedName) {
                        sum += service.time;
                    }
                }
            }
            let array1945 = [];
            for (let x of this.records.filter(
                (records) => records.date == this.formData.date
            )) {
                array1945.push(x.time);
            }
            array1945.push("20:00:00");
            for (let x of array1945) {
                let h = 0;
                let m = sum + Number(i.slice(3, 5));
                if (m >= 60) {
                    while (m >= 60) {
                        m -= 60;
                        h += 1;
                    }
                }
                h = Number(i.slice(0, 2)) + h;
                let coptime1 = new Date(0, 0, 0, h, m, 0).toTimeString();

                if (
                    i.slice(0, 5) < x.slice(0, 5) &&
                    coptime1.slice(0, 5) > x.slice(0, 5)
                ) {
                    if (this.formData.time == i.slice(0, 5)) {
                        this.formData.time = null;
                    }
                    return true;
                }
            }
            for (let x of this.records.filter(
                (records) => records.date == this.formData.date
            )) {
                if (i.slice(0, 5) == x.time.slice(0, 5)) {
                    if (this.formData.time == i.slice(0, 5)) {
                        this.formData.time = null;
                    }
                    return true;
                }
                let h = 0;
                let m = Number(x.sTime);
                if (m >= 60) {
                    while (m >= 60) {
                        m -= 60;
                        h += 1;
                    }
                }
                h = Number(x.time.slice(0, 2)) + h;
                let coptime = new Date(0, 0, 0, h, m, 0).toTimeString();
                if (
                    i.slice(0, 5) < coptime.slice(0, 5) &&
                    i.slice(0, 5) > x.time.slice(0, 5)
                ) {
                    return true;
                }
            }
        },
        disRec: function () {
            if (
                this.formData.date == null ||
                this.formData.checkedNames == [] ||
                this.formData.time == null
            ) {
                return true;
            } else return false;
        },
        disKey: function (i) {
            let x = this.n + parseInt(i);
            return x;
        },
        recording: function (value, name, id) {
            const statusValue = value;
            const statusName = name;
            const recordId = id;
            this.$swal
                .fire({
                    title: "Вы уверены?",
                    text: `Вы точно хотите изменить статус на "${statusName}"?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post("/api/recordsstatus", {
                                statusValue: value,
                                statusName: name,
                                recordId: id,
                            })
                            .then((data) => {
                                this.$swal.fire(
                                    "Успешно!",
                                    data.data.messege,
                                    "success"
                                );
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            });
                    }
                })
                .catch((err) => {
                    alert(err.data);
                });
        },
        guestCencel(id) {
            this.$swal
                .fire({
                    title: "Вы уверены?",
                    text: `Вы точно хотите изменить статус на "Отменен"?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post("/api/recordgs", {
                                recordgId: id,
                            })
                            .then((data) => {
                                this.$swal.fire(
                                    "Успешно!",
                                    data.data.messege,
                                    "success"
                                );
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            });
                    }
                })
                .catch((err) => {
                    alert(err.data);
                });
        },
        CreateRecord() {
            axios
                .post("/api/finalrecords", this.formData)
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
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    // sweetalert
                })
                .catch((err) => {
                    //alert(err.data)
                });
        },

        openBoard(id, name, phone_number) {
            this.formData.guestRec = id;
            this.formData.name = name;
            this.formData.phone_number = phone_number;
        },
        closeBoard() {
            this.formData.guestRec = 0;
        },
        statusColor(color) {
            return `text-${color}`;
        },
    },
    computed: {
        Timebuttons: function () {
            let a = [];
            for (let h = 11; h <= 19; h++) {
                for (let m = 0; m <= 55; m += 15) {
                    a.push(new Date(0, 0, 0, h, m, 0).toTimeString());
                }
            }
            return a;
        },
    },
    created() {
        fetch("/api/services")
            .then((response) => response.json())
            .then((services) => {
                this.services = services;
            });
        fetch("/api/recordsstatus")
            .then((response) => response.json())
            .then((recordsstatus) => {
                this.recordsstatus = recordsstatus;
            });
        fetch("/api/categories")
            .then((response) => response.json())
            .then((categories) => {
                this.categories = categories;
            });
        fetch("/api/recordgs")
            .then((response) => response.json())
            .then((recordgs) => {
                this.recordgs = recordgs;
            });
        fetch("/api/statuses")
            .then((response) => response.json())
            .then((statuses) => {
                this.statuses = statuses;
            });
        fetch("/api/servicehistory")
            .then((response) => response.json())
            .then((servicehistory) => {
                this.servicehistory = servicehistory;
            });
        fetch("/api/records")
            .then((response) => response.json())
            .then((records) => {
                this.records = records;
            });
    },
};
</script>
