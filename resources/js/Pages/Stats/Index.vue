<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Stats global</h1>
            <div class="flex space-x-4">
                <div class="w-48">
                    <VLabel>Section</VLabel>
                    <VSelect :options="['Toutes', '1', '2','3', '4', 'SPV']" v-model="section" :clearable="false"></VSelect>
                </div>
                <div class="w-48">
                    <VLabel>Type</VLabel>
                    <VSelect :options="['Tous', 'Jour', 'Nuit']" v-model="type" :clearable="false"></VSelect>
                </div>
            </div>
        </header>
        <div>
            <StatsTable :type="type" :agents="agents" :section="section"/>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VSelect from "vue-select";
import {ref} from "vue";
import StatsTable from "@/Pages/Stats/StatsTable.vue";
import VLabel from "@/Components/Base/VLabel.vue";
import {usePage} from "@inertiajs/vue3";

defineOptions({layout: AuthenticatedLayout})
defineProps({agents: Array})

const type = ref('Tous')
const section = ref(usePage().props.auth.user.section)
</script>
