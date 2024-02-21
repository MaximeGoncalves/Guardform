<template>
    <SwitchGroup>
        <div class="flex flex-shrink-0 items-center">
            <Switch
                :class="modelValue ? ' bg-primary-600' : 'dark:bg-dark-gray-700 bg-light-gray-300'"
                :model-value="modelValue"
                class="relative inline-flex h-5 w-8 flex-shrink-0 items-center self-start rounded-full p-[2px] focus:ring-primary-100 focus:ring-4 dark:focus:ring-primary-900"
                @update:modelValue="updateValue"
            >
            <span
                :class="modelValue ? 'translate-x-3' : 'translate-x-0'"
                class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition dark:bg-dark-gray-800"
            />
            </Switch>
            <SwitchLabel v-if="label" class="ml-4 text-sm text-secondary">{{
                    label
                }}
            </SwitchLabel>
        </div>
    </SwitchGroup>
</template>

<script setup>
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

defineProps(['modelValue', 'label'])
const emit = defineEmits(['update:modelValue'])

function updateValue (value) {
    emit('update:modelValue', value)
}
</script>
