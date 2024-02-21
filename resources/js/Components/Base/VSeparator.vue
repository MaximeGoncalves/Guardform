<template>
  <div class="mt-6 mb-2 flex items-center space-x-2">
        <span v-if="title" class="flex-shrink-0 font-medium text-secondary">{{
            title
          }}</span>
    <hr class="my-0 w-full border-t border-secondary"/>
  </div>
</template>
<script setup>
defineProps(['title'])
</script>
