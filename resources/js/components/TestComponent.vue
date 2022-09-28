<template>
    <v-app class="test10" style="background-color: #bde7f5">
        <div class="backgroundNav3">
            <v-container>
                <v-card class="mx-auto test" max-width="1024">
                    <v-toolbar flat color="deep-purple lighten-3" dark>
                        <v-toolbar-title>Выбор услуг</v-toolbar-title>
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
                    {{ checkedCat }}
                    <v-card-text
                        v-for="category in categories"
                        :key="category.id"
                        v-if="checkedCat === category.id"
                    >
                        <h2 class="text-h6 mb-2">{{ category.name }}</h2>
                        {{ formData.checkedNames }}
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
                                            services.category_id == category.id
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
                            {{ formData.date }}
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
                                Записаться
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </v-container>
        </div>
    </v-app>
</template>
<script>
// import axios from "axios";
export default {
    data() {
        return {
            records: [],
            services: [],
            categories: [],
            formData: {
                checkedNames: [],
                date: null,
                time: null,
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
                    i.slice(0, 5) <
                    new Date()
                        .toLocaleTimeString("en-US", {
                            hour12: false,
                        })
                        .slice(0, -3)
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
                let m = Number(x.Stime) + Number(x.time.slice(3, 5));
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
        CreateRecord() {
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
        fetch("/api/records")
            .then((response) => response.json())
            .then((records) => {
                this.records = records;
            });
        fetch("/api/categories")
            .then((response) => response.json())
            .then((categories) => {
                this.categories = categories;
            });
    },
};
</script>
