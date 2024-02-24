<template>
    <div>
        <label v-if="label" class="mb-1 block text-sm font-medium text-light-gray-700 dark:text-dark-gray-300">{{
                label
            }}
            <span class="text-red-500" v-if="required">*</span>
        </label>
        <div :class="{'flex items-center' :suffix}" class="relative">
            <div class="absolute inset-y-0 mt-px flex items-center pl-3.5">
                <component :is="icon" class="h-5 w-5 font-medium text-gray-500 dark:text-gray-300"></component>
            </div>
            <input
                :name="name"
                ref="input"
                :class="`
                ${error ? 'border-red-500 dark:focus:ring-red-900 focus:border-red-500 pr-10 dark:focus:border-red-500' : 'border-light-gray-300 dark:border-dark-gray-700 focus:border-primary-500 dark:!ring-primary-900 !ring-primary-100 dark:focus:border-primary-300' }
                ${icon ? 'w-full pl-10' : ''}
                ${suffix ? 'rounded-l-md' : 'rounded-md'}
                `"
                :disabled="disabled"
                :max="max"
                :placeholder="placeholder"
                :required="required"
                :type="type"
                :value="modelValue"
                class="block w-full border bg-white p-2 text-sm ring-offset-0 placeholder:text-placeholder text-primary bg-primary focus:outline-none disabled:bg-disabled"
                @change="$emit('change')"
                @input="$emit('update:modelValue', $event.target.value)"/>
            <div v-if="error" class="absolute inset-y-0 right-0 mt-px flex items-center pr-3.5">
                <ExclamationCircleIcon class="h-5 w-5 text-red-500"/>
            </div>
            <div v-if="suffix"
                 class="flex items-center rounded-r-md border border-l-0 p-2 border-secondary bg-secondary">
                <p>{{ suffix }}</p>
            </div>
        </div>
        <span v-if="hint" class="text-xs text-quarterary">{{ hint }}</span>
        <span v-if="error" class="text-sm text-red-500">{{ error }}</span>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline'

// eslint-disable-next-line no-unused-vars
const props = defineProps({
    name: String,
    modelValue: [Object, String],
    label: String,
    disabled: Boolean,
    icon: String,
    hint: String,
    placeholder: String,
    error: String,
    type: String,
    required: Boolean,
    max: Number,
    suffix: String
})

const input = ref(null)
defineEmits(['update:modelValue', 'change'])

defineExpose({
    input
})

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})
</script>
