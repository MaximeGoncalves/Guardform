<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Stats global</h1>
            <div class="w-64">
                <VSelect :options="['Tous', 'Jour', 'Nuit']" v-model="type"></VSelect>
            </div>
        </header>
        <div>
            <StatsTable :type="type" :agents="agents"/>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VSelect from "vue-select";
import {ref} from "vue";
import StatsTable from "@/Pages/Stats/StatsTable.vue";

defineOptions({layout: AuthenticatedLayout})
defineProps({agents: Array})

const type = ref('Tous')
</script>
