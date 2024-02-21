<template>
    <div :class="classes" class="flex-shrink-0 rounded-full">
        <img :src="src" class="h-full w-full rounded-full object-cover" loading="lazy"/>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    },
    src: {
        type: String,
        required: true
    }
})
const classes = computed(function () {
    switch (props.size) {
    case 'xs':
        return 'w-4 h-4'
    case 'sm':
        return 'w-6 h-6'
    case 'md':
        return 'w-8 h-8'
    case 'lg':
        return 'w-10 h-10'
    case 'xl':
        return 'w-12 h-12'
    case '2xl':
        return 'w-20 h-20'
    }
})
</script>
