<template>
    <div class="text-gray-950 bg-white p-4 rounded ring-1 ring-gray-200">
        <h2 class="text-lg font-semibold mb-2">{{ title }}</h2>
        <div class="space-y-2">
            <div class="flex items-center uppercase text-xs text-gray-500">
                <div class="w-[72px]"></div>
                <div class="w-1/2">Jour</div>
                <div class="w-1/2">Nuit</div>
            </div>
            <div class="flex items-center">
                <div class="w-16">
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
                <div class="w-16">
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
                <div class="w-16">
                    <div class="text-gray-500 text-xs p-px">CE BAT</div>
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ ce1_day?.name }}
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ ce1_night?.name }}
                </div>
            </div>
            <hr>
            <div class="flex items-center">
                <div class="w-16">
                    <div class="text-gray-500 text-xs p-px">CE BAL</div>
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ ce2_day?.name }}
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ ce2_night?.name }}
                </div>
            </div>
            <hr>
            <div class="flex items-center">
                <div class="w-16">
                    <div class="text-gray-500 text-xs p-px">EQ BAT</div>
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ eq1_day?.name }}
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ eq1_night?.name }}
                </div>
            </div>
            <hr>
            <div class="flex items-center">
                <div class="w-16">
                    <div class="text-gray-500 text-xs p-px">EQ BAL</div>
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ eq2_day?.name }}
                </div>
                <div class="w-1/2 px-1 min-h-6">
                    {{ eq2_night?.name }}
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    title: String,
    ca_day: Object,
    ca_night: Object,
    cond_day: Object,
    cond_night: Object,
    ce1_day: Object,
    ce1_night: Object,
    ce2_day: Object,
    ce2_night: Object,
    eq1_day: Object,
    eq1_night: Object,
    eq2_day: Object,
    eq2_night: Object,
})
</script>
