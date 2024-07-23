<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
</script>

<template>
    <Head title="Companies"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="p-6">
                        <li class="pb-2" v-for="company in companies" :key="company.id">
                            <Link class="text-blue-500" :href="route('company', company.id)">{{
                                    company.name
                                }}
                            </Link>
                            <div class="text-gray-600">{{ company.general_info }}</div>
                        </li>
                    </ul>
                    <form class="p-6" @submit.prevent="addCompany">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Добавить компанию</label>
                            <input v-model="name" placeholder="Название" type="text" class="mt-1 block w-full"/>
                            <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</span>

                            <input v-model="inn" placeholder="ИНН" type="text" class="mt-1 block w-full"/>
                            <span v-if="errors.inn" class="text-red-500 text-sm">{{ errors.inn }}</span>

                            <input v-model="general_info" placeholder="Общая информация" type="text"
                                   class="mt-1 block w-full"/>
                            <span v-if="errors.general_info" class="text-red-500 text-sm">{{
                                    errors.general_info
                                }}</span>

                            <input v-model="ceo" placeholder="Генеральный директор" type="text"
                                   class="mt-1 block w-full"/>
                            <span v-if="errors.ceo" class="text-red-500 text-sm">{{ errors.ceo }}</span>

                            <input v-model="address" placeholder="Адрес" type="text" class="mt-1 block w-full"/>
                            <span v-if="errors.address" class="text-red-500 text-sm">{{ errors.address }}</span>

                            <input v-model="phone" placeholder="Телефон" type="text" class="mt-1 block w-full"/>
                            <span v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone }}</span>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
export default {
    data() {
        return {
            companies: [],
            errors: {},
            name: "",
            inn: "",
            general_info: "",
            ceo: "",
            address: "",
            phone: ""
        }
    },
    methods: {
        async getCompanies() {
            const {data} = await axios.get(`companies`);
            this.companies = data
        },
        validateFields() {
            let errors = {};

            if (!this.name) {
                errors.name = "Название обязательно";
            }
            if (!this.inn) {
                errors.inn = "ИНН обязательно";
            } else if (!/^\d+$/.test(this.inn)) {
                errors.inn = "ИНН должен содержать только цифры";
            }
            if (!this.general_info) {
                errors.general_info = "Общая информация обязательна";
            }
            if (!this.ceo) {
                errors.ceo = "Генеральный директор обязателен";
            }
            if (!this.address) {
                errors.address = "Адрес обязателен";
            }
            if (!this.phone) {
                errors.phone = "Телефон обязателен";
            } else if (!/^\d+$/.test(this.phone)) {
                errors.phone = "Телефон должен содержать только цифры";
            }

            return errors;
        },
        async addCompany() {
            this.errors = this.validateFields();

            if (Object.keys(this.errors).length === 0) {
                const newCompany = {
                    name: this.name,
                    inn: this.inn,
                    general_info: this.general_info,
                    ceo: this.ceo,
                    address: this.address,
                    phone: this.phone
                };
                const {data} = await axios.post('companies', newCompany)
                this.companies = data
            }
        }
    },
    mounted() {
        this.getCompanies();
    }
}
</script>
