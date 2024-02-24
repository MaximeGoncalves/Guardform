<template>
    <button :disabled="isDisabled"
            :type="type"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 disabled:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <component :is="icon" v-if="icon" class="mr-2 h-4 w-4"/>
        <slot/>
        <Spinner v-if="isLoading" class="ml-2"/>
    </button>
</template>


<script setup>
import Spinner from '@/Components/Spinner.vue'
import {computed} from 'vue'

const isDisabled = computed(() => {
    if (props.form) {
        if (!props.form.isDirty || props.loading) {
            return true
        }
    } else if (props.disabled || props.loading) {
        return true
    }
})
const isLoading = computed(() => {
    if (props.form) {
        if (props.form.processing || props.loading) {
            return true
        }
    } else if (props.loading) {
        return true
    }
})

const props = defineProps({
    disabled: {
        type: Boolean,
        default: false
    },
    loading: {
        type: Boolean,
        default: false
    },
    icon: {
        default: null
    },
    type: {
        type: String,
        default: 'submit'
    },
    form: {
        type: Object,
        nullable: true
    }
})
</script>

