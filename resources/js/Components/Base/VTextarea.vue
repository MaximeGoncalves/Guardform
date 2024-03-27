<template>
    <div>
        <label v-if="label" class="mb-1 block text-sm font-medium text-secondary">{{ label }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 mt-px flex items-center pl-3.5">
                <component :is="icon" class="h-5 w-5 font-medium text-tertiary"></component>
            </div>
            <textarea
                ref="input"
                :rows="rows"
                :class="`
                ${error ? 'border-red-500 dark:focus:ring-red-900 focus:border-red-500 pr-10 dark:focus:border-red-500' : 'border-primary focus:border-primary-500 dark:ring-primary-900 ring-primary-100 dark:focus:border-primary-300' }
                ${icon ? 'w-full pl-10' : ''}
                `"
                :disabled="disabled"
                :placeholder="placeholder"
                :required="required"
                :value="modelValue"
                class="block w-full rounded-lg border p-2 text-sm text-gray-900 ring-offset-0 bg-primary placeholder:text-placeholder text-primary focus:outline-none focus:ring-1 disabled:bg-disabled"
                @change="$emit('change')"
                @input="$emit('update:modelValue', $event.target.value)"/>
            <div v-if="error" class="absolute inset-y-0 right-0 mt-px flex items-center pr-3.5">
                <ExclamationCircleIcon class="h-5 w-5 text-red-500"/>
            </div>
        </div>
        <span v-if="hint" class="text-xs text-tertiary">{{ hint }}</span>
        <span v-if="error" class="text-sm text-red-500">{{ error }}</span>

    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline'

defineProps(['modelValue', 'label', 'disabled', 'icon', 'hint', 'placeholder', 'error', 'required', 'rows'])
const input = ref(null)
const emit = defineEmits(['update:modelValue', 'change'])

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})
</script>
