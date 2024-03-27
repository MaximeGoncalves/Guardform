<template>
    <div class="text-gray-950 bg-white p-4 rounded ring-1 ring-gray-200">
        <h2 class="font-semibold mb-2">{{ title }}</h2>
        <div v-if=" day === night">
            <template v-if="day === undefined">
                <small class="text-gray-500">Aucun</small>
            </template>
            <template v-else>
                {{ day }}
            </template>
        </div>
        <template v-else>
            <div class="flex items-center uppercase text-xs text-gray-500">
                <div class="w-1"></div>
                <div class="w-1/2">Jour</div>
                <div class="w-1/2">Nuit</div>
            </div>
            <div class="flex items-center">
                <div class="w-1/2 px-1 min-h-6">
                    {{ day }}
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ night }}
                </div>
            </div>
        </template>
    </div>
</template>
<script setup>
import VBadge from "@/Components/Base/VBadge.vue";

defineProps({
    title: String,
    day: String,
    night: String,
})
</script>
