<template>
    <label class="mb-1 block text-sm font-medium text-secondary">
        <slot></slot>
        <span class="text-red-500 ml-1" v-if="required">*</span>
    </label>
</template>

<script setup>
defineProps({
    required: Boolean
})
</script>
