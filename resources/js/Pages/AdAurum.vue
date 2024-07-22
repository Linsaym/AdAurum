<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
    <Head title="AdAurum"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ company.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul>
                            <li>ИНН: {{ company.inn }}</li>
                            <li>Общая информация: {{ company.general_info }}</li>
                            <li>Главный директор: {{ company.ceo }}</li>
                            <li>Адрес: {{ company.address }}</li>
                            <li>Телефон: {{ company.phone }}</li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                    <div class="p-6 text-gray-900">
                        <div class="font-semibold text-xl text-gray-800 leading-tight">Комментарии компании</div>
                        <div v-if="comments.length">
                            <ul>
                                <li v-for="(comment, index) in comments" :key="index">
                                    {{ comment.user.name }}: {{ comment.comment }}
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            Нет комментариев.
                        </div>
                        <form @submit.prevent="addComment">
                            <div class="mt-4">
                                <label for="new-comment" class="block text-sm font-medium text-gray-700">Добавить
                                    комментарий</label>
                                <input v-model="newComment" id="new-comment" type="text" class="mt-1 block w-full"/>
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
        </div>
    </AuthenticatedLayout>
</template>
<script>
export default {
    data() {
        return {
            companyId: 1,
            company: {
                name: "",
                inn: "",
                general_info: "",
                ceo: "",
                address: "",
                phone: ""
            },
            comments: [],
            newComment: "",
        }
    },
    methods: {
        async getCompany() {
            const {data} = await axios.get(`companies/${this.companyId}`);
            this.company = data
        },
        async getComments() {
            const {data} = await axios.get(`companies/${this.companyId}/comments`);
            this.comments = data
        },
        async addComment() {
            const newComment = this.newComment.trim()
            if (newComment) {
                const {data} = await axios.post(`companies/${this.companyId}/comments`, {
                    company_id: 1,
                    comment: newComment
                });
                this.newComment = '';
                this.comments = data;
            }
        }
    },
    mounted() {
        this.getCompany();
        this.getComments();
    }
}
</script>
