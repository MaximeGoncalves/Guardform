<template>
  <div class="flex items-center">
    <input :checked="modelValue"
           :class="modelValue ? '': 'bg-primary-50'"
           :disabled="disabled"
           class="rounded border-primary accent-primary-50 text-primary-600 hover:border-primary-600 focus:ring-primary-300 focus:ring-4 focus:ring-offset-0 disabled:bg_disabled hover:disabled:border_disabled"
           type="checkbox"
           @update:modelValue="$emit('update:modelValue', modelValue)"
    >
    <label v-if="label" class="ml-3">{{ label }}</label>

  </div>

</template>

<script setup>
defineProps(['modelValue', 'label', 'disabled'])
defineEmits(['update:modelValue'])

</script>
