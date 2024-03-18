<template>
    <VSelect :label="label"
             :options="filteredOptions"
             :placeholder="placeholder"
             v-model="value"
             :reduce="reduce"
             :selectable="selectable">
        <template #option="option">
            <div class="flex items-center justify-between">
                <h3 >{{ option.fullname }}</h3>
                <div class="space-x-0.5" v-if="option[stats]">
                    <small v-if="option[stats].last" class="bg-primary px-2 py-0.5 rounded text-primary">{{ moment(option[stats].last).locale('fr').format('LL') }}</small>
                    <small v-if="option[stats].count" class="bg-gray-900 px-2 py-0.5 rounded text-gray-300">{{ option[stats].count }}</small>
                </div>
            </div>
        </template>
        <template #selected-option="option">
           <VBadge color="brand" v-if="prefix" class="mr-2">{{ prefix }}</VBadge> <span>{{ option.fullname }}</span>
        </template>
    </VSelect>
</template>
<script setup>
import VSelect from "vue-select";
import moment from "moment/min/moment-with-locales";
import {computed} from "vue";
import VBadge from "@/Components/Base/VBadge.vue";

const props = defineProps({
    label: String,
    options: Array,
    placeholder: String,
    prefix: String,
    selectable: Function,
    reduce: Function,
    stats: {
        type: String,
        required: true
    }
})

const value = defineModel()

const filteredOptions = computed(() => {
    return props.options.sort((a, b) => {
        if (a[props.stats]?.count !== b[props.stats]?.count) {
            return (a[props.stats]?.count || 0) - (b[props.stats]?.count || 0);
        } else {
            // Si count est égal, triez par last
            return (moment(a[props.stats]?.last) || 0) - (moment(b[props.stats]?.last) || 0);
        }
    });
})
</script>
