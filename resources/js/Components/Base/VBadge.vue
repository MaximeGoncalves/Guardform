<script setup>
import { computed } from 'vue'

const { size, color, icon } = defineProps({
    icon: {
        default: null
    },
    size: {
        type: String,
        default: 'sm'
    },
    color: {
        type: String,
        default: 'default'
    }
})

const selectedColor = computed(function () {
    switch (color) {
    case 'brand':
        return 'bg-primary-50 border-primary-200 text-primary-700 dark:bg-primary-950 dark:border-primary-800 dark:text-primary-300'
    case 'red':
        return 'bg-red-50 border-red-200 text-red-700 dark:bg-red-950 dark:border-red-800 dark:text-red-300'
    case 'emerald':
        return 'bg-emerald-50 border-emerald-200 text-emerald-700 dark:bg-emerald-950 dark:border-emerald-800 dark:text-emerald-300'
    case 'green':
        return 'bg-green-50 border-green-200 text-green-700 dark:bg-green-950 dark:border-green-800 dark:text-green-300'
    case 'cyan':
        return 'bg-cyan-50 border-cyan-200 text-cyan-700 dark:bg-cyan-950 dark:border-cyan-800 dark:text-cyan-300'
    case 'orange':
        return 'bg-orange-50 border-orange-200 text-orange-700 dark:bg-orange-950 dark:border-orange-800 dark:text-orange-300'
    case 'yellow':
        return 'bg-yellow-50 border-yellow-200 text-yellow-700 dark:bg-yellow-950 dark:border-yellow-800 dark:text-yellow-300'
    case 'default':
        return 'bg-primary border-primary text-secondary'
    }
})
const sizeClasses = computed(function () {
    switch (size) {
    case 'sm':
        return 'px-2 py-0.5'
    case 'md':
        return 'px-3 py-1'
    case 'lg':
        return 'px-3 py-1.5'
    }
})
</script>
<template>
    <div
        :class="`border inline-flex items-center font-medium text-xs rounded-lg ${sizeClasses} ${selectedColor}`">
        <component :is="icon" v-if="icon" class="mr-2 h-4 w-4"></component>
        <slot/>
    </div>
</template>
