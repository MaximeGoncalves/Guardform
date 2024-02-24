<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Gardes</h1>
            <PrimaryButton @click="showModal= true">Nouvelle Garde</PrimaryButton>
        </header>

        <table class="bg-white shadow rounded">
            <thead>
            <tr>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="guard in guards" :key="guard.id">
                <td class="w-full">{{ moment(guard.date).format('DD/MM/YYYY') }}</td>
                <td>
                    <div class="flex items-center space-x-2">
                        <Link
                            v-for="form in guard.forms" :key="form.id"
                            :href="route('forms.edit', form.id)"
                             class="py-1 px-2 rounded"
                             :class="form.is_night
                             ? 'bg-gray-800 text-white'
                             : 'bg-gray-400 text-white'">
                            {{ form.is_night ? 'Nuit' : 'Jour' }}
                        </Link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <VModal :is-open="showModal" @close="showModal = false" @confirm="store">
            <template #title>Nouvelle garde</template>
            <template #content>
                <VueDatePicker :enable-time-picker="false" locale="fr-FR" v-model="form.date"></VueDatePicker>

                <InputError :message="form.errors.date"></InputError>
            </template>
        </VModal>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import {ref} from "vue";
import moment from 'moment/min/moment-with-locales';
import VModal from "@/Components/Base/VModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm, Link} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

defineOptions({layout: AuthenticatedLayout})
defineProps({guards: Array})
const form = useForm({
    date: moment().locale('fr').add(4, 'days')
})
const showModal = ref(false)

function store() {
    form.post(route('guards.store'), {
        onSuccess: () => {
            showModal.value = false
            form.reset()
        }
    })
}
</script>
