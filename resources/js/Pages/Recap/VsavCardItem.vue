<template>
    <div class="text-gray-950 bg-white p-4 rounded ring-1 ring-gray-200">
    <h2 class="text-lg font-semibold mb-4 text-gray-950">{{ title }}</h2>
    <div class="space-y-2">
        <div class="flex items-center uppercase text-xs text-gray-500">
            <div class="w-16"></div>
            <div class="w-1/2">Jour</div>
            <div class="w-1/2">Nuit</div>
        </div>
        <div class="flex items-center">
            <div class="w-14">
                <div class="text-gray-500 text-xs p-px">CA</div>
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ ca_day?.name }}
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ ca_night?.name }}
            </div>
        </div>
        <hr>
        <div class="flex items-center">
            <div class="w-14">
                <div class="text-gray-500 text-xs p-px">COND</div>
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ cond_day?.name }}
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ cond_night?.name }}
            </div>
        </div>
        <hr>
        <div class="flex items-center">
            <div class="w-14">
                <div class="text-gray-500 text-xs p-px">EQ</div>
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ eq_day?.name }}
            </div>
            <div class="w-1/2 px-1 min-h-6">
                {{ eq_night?.name }}
            </div>
        </div>
    </div>
    </div>
</template>
<script setup>
import VBadge from "@/Components/Base/VBadge.vue";

defineProps({
    title: String,
    ca_day: Object,
    ca_night: Object,
    cond_day: Object,
    cond_night: Object,
    eq_day: Object,
    eq_night: Object,
})
</script>
