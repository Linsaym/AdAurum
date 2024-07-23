<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
</script>

<template>
    <Head :title="company.name"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ company.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul>
                            <li v-for="field in fields">
                                <Link class="text-blue-500" :href="route('field', {id: id, fieldId: field.id})">
                                    {{ fieldsNames[field.id] }}
                                </Link>
                                : {{ company[field.name] }}
                                <button class="ml-2" @click="showAddCommentModal(field.id)">+</button>
                                <div>
                                    <ul>
                                        <li class="text-gray-400" v-for="comment in field.comments">
                                            {{ formatDate(comment.created_at) }}
                                            <strong>{{
                                                    comment.user.name
                                                }}</strong>: {{ comment.comment }}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <Modal :show="isShowAddCommentModal" @close="closeModal">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Добавить комментарий к полю "{{ fieldsNames[selectedField] }}"
                        </h2>
                        <div class="mt-2">
                            <InputLabel for="password" value="Password" class="sr-only"/>

                            <TextInput
                                v-model="newCommentForField"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="Комментарий"
                            />
                            <div class="mt-2">
                                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                <SecondaryButton @click="addCommentForField">Add</SecondaryButton>
                            </div>
                        </div>

                    </div>
                </Modal>
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
                                <label class="block text-sm font-medium text-gray-700">Добавить комментарий</label>
                                <input maxlength="999" v-model="newComment" type="text" class="mt-1 block w-full"/>
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
import axios from "axios";

export default {
    props: {
        id: {
            default: 1,
            type: Number
        }
    },
    data() {
        return {
            company: {
                name: "Загрузка...",
                inn: "",
                general_info: "",
                ceo: "",
                address: "",
                phone: ""
            },
            fieldsNames: {
                //Обновить при изменении таблицы company_fields
                '1': 'Название',
                '2': 'ИНН',
                '3': 'Общая информация',
                '4': 'Генеральный директор',
                '5': 'Адрес',
                '6': 'Телефон'
            },
            newCommentForField: "",
            isShowAddCommentModal: false,
            selectedField: 1,
            comments: [],
            newComment: "",
            fields: []
        }
    },
    methods: {
        async getCompany() {
            const {data} = await axios.get(`companies/${this.id}`);
            this.company = data
        },
        async getComments() {
            const {data} = await axios.get(`companies/${this.id}/comments`);
            this.comments = data
        },
        async getCompanyFieldsWithComments() {
            const {data} = await axios.get(`http://127.0.0.1:8000/companies/${this.id}/fields`)
            this.fields = data
        },
        async addComment() {
            const newComment = this.newComment.trim()
            if (newComment) {
                const {data} = await axios.post(`companies/${this.id}/comments`, {
                    company_id: 1,
                    comment: newComment
                });
                this.newComment = '';
                this.comments = data;
            }
        },
        closeModal() {
            this.isShowAddCommentModal = false
        },
        showAddCommentModal(fieldId) {
            this.selectedField = fieldId
            this.isShowAddCommentModal = true
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            return `${date.getDate().toString().padStart(2, '0')}.${(date.getMonth() + 1).toString().padStart(2, '0')}.${date.getFullYear()} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;
        },
        async addCommentForField() {
            const newComment = this.newCommentForField.trim()
            if (newComment) {
                const {data} = await axios.post(`companies/${this.id}/field_comment/${this.selectedField}`, {
                    comment: newComment
                });
                this.newCommentForField = '';
                this.fields = this.fields.map(el => el.id === this.selectedField ? {...el, comments: data} : el);
            }
            this.isShowAddCommentModal = false
        }
    },
    mounted() {
        this.getCompany();
        this.getComments();
        this.getCompanyFieldsWithComments();
    }
}
</script>
