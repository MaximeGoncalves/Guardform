<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow">
            <h1 class="font-medium text-xl">Form</h1>
        </header>

        <div class="flex space-x-2">
            <nav class="bg-white w-1/5">
                <h2>
                    Agents adz
                </h2>

                <div>
                    <ul>
                        <li v-for="agent in form.agents" :key="agent.id">
                            {{ agent.firstname }} {{ agent.name }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="flex-1 bg-white">

            </div>
        </div>

    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";
import moment from 'moment/min/moment-with-locales';
import {useForm} from "@inertiajs/vue3";

defineOptions({layout: AuthenticatedLayout})
defineProps({form: Object})

const data = useForm({})
const showModal = ref(false)

function store() {
    data.post(route('guards.store'), {
        onSuccess: () => {
            showModal.value = false
            form.reset()
        }
    })
}
</script>
