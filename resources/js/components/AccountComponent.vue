<template>
    <div class="backgroundNav3 py-20">
        <div class="min-h-screen ">
            <div class="bg-[#e4f9fe]/75 rounded-lg sm:mx-5 sm:p-5 p-2">
                <h1 class="font-sans font-bold text-xl uppercase">История Записей</h1>
                <div>
                    <div class="d-flex flex-row pb-4 mt-3 mb-1 ">
                        <v-btn v-bind="size" style="background-color: #b6b6ff;" @click="all">
                            Открыть все
                        </v-btn>
                        <v-btn v-bind="size" style="background-color: #b6b6ff;" @click="none">
                            Закрыть все
                        </v-btn>
                    </div>
                    <v-expansion-panels  disabled="" expand-icon="">
                        <v-expansion-panel>
                            <v-expansion-panel-header class="bg-[#b6b6ff] !px-2 sm:!pl-5 sm:!pr-5">
                                <p class="text-left sm:text-base md:text-lg text-sm">№</p>
                                <p class="text-left sm:text-base md:text-lg text-sm">Дата</p>
                                <p class="text-left sm:text-base md:text-lg text-sm">Время</p>
                                <p class="text-left sm:text-base md:text-lg text-sm">Общая стоимость</p>
                                <p class="text-left sm:text-base md:text-lg text-sm">Общее время</p>
                                <p class="text-left sm:text-base md:text-lg text-sm">Статус</p>
                            </v-expansion-panel-header>
                        </v-expansion-panel>
                    </v-expansion-panels>
                    <div class="overflow-auto overflow-y h-80">
                        <v-expansion-panels v-model="panel" multiple>
                            <v-expansion-panel v-for="record, index of records" :key="index + 1">
                                <v-expansion-panel-header class="bg-[#ccccff] !px-2 sm:!pl-5 sm:!pr-5">
                                    <p class="text-left sm:text-base md:text-lg text-sm">{{ index + 1 }}</p>
                                    <p class="text-left sm:text-base md:text-lg text-sm">{{ new Date(record.date).toLocaleDateString('ru').replace(/\//gi,'.') }}</p>
                                    <p class="text-left sm:text-base md:text-lg text-sm">{{ record.time.slice(0,5) }}</p>
                                    <p class="text-left sm:text-base md:text-lg text-sm">{{ record.sPrice }} руб</p>
                                    <p class="text-left sm:text-base md:text-lg text-sm">{{ record.sTime }} мин</p>
                                    <p :class="'text-left sm:text-base md:text-lg text-sm text-' + record.status.vueColor + ' w-20'">
                                        {{ record.status.name }}
                                    </p>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content id="innerExPan" class="bg-[#b6b6ff]">
                                    <v-simple-table dense class="mt-2">
                                        <template v-slot:default>
                                            <thead>
                                                <tr class="bg-[#b6b6ff]">
                                                    <th class="text-left sm:!text-sm md:!text-base lg:!text-lg">Название услуги</th>
                                                    <th class="text-left sm:!text-sm md:!text-base lg:!text-lg">Категория</th>
                                                    <th class="text-left sm:!text-sm md:!text-base lg:!text-lg">Цена</th>
                                                    <th class="text-left sm:!text-sm md:!text-base lg:!text-lg">Время</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-[#ccccff] hover:!bg-[#e0e0fc]"
                                                    v-for="servicehistory of record['servicehistory']">
                                                    <td class="text-left sm:!text-sm md:!text-base lg:!text-lg">{{ servicehistory.service.name }}</td>
                                                    <td class="text-left sm:!text-sm md:!text-base lg:!text-lg">{{ servicehistory.service.category.name }}</td>
                                                    <td class="text-left sm:!text-sm md:!text-base lg:!text-lg">{{ servicehistory.service.price }} руб</td>
                                                    <td class="text-left sm:!text-sm md:!text-base lg:!text-lg">{{ servicehistory.service.time }} мин</td>
                                                </tr>
                                            </tbody>
                                        </template>
                                    </v-simple-table>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            records: null,
            services: null,
            panel: [],
            page: 1
        }
    },
    methods: {
        // Create an array the length of our items
        // with all values as true
        all() {
            this.panel = [...Array(this.records.length).keys()].map((k, i) => i)
        },
        // Reset the panel
        none() {
            this.panel = []
        },
    },
    computed: {
        size() {
            const size = { xs: 'small'}[this.$vuetify.breakpoint.name];
            return size ? { [size]: true } : {}
        }
    },
    created() {
        fetch("/api/userrecords")
            .then((response) => response.json())
            .then((records) => {
                this.records = records.reverse();
            });
        fetch("/api/services")
            .then((response) => response.json())
            .then((services) => {
                this.services = services;
            });
    },
}
</script>