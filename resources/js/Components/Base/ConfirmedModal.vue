<template>
  <TransitionRoot :show="isOpen" appear as="template">
    <Dialog as="div" class="relative z-10" @close="closeModal">
      <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-50"/>
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
            class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
          >
            <DialogPanel
                :class="maxWidth"
                class="w-full transform overflow-hidden rounded-2xl border p-6 text-left align-middle shadow-xl transition-all border-secondary bg-primary"
            >
              <div class="mb-6 flex items-center justify-center">
                <div :class="classIcon"
                     class="rounded-full p-2 ring-8">
                  <component :is="icon" class="h-9 w-9 font-semibold"/>
                </div>
              </div>
              <DialogTitle
                  as="h3"
                  class="text-center text-lg font-medium leading-6 text-gray-900"
              >
                <slot name="title"></slot>
              </DialogTitle>
              <div class="mt-2 mb-8 text-center text-sm text-gray-900 dark:text-gray-200">
                <slot name="content"></slot>
              </div>

              <div class="mt-4 flex justify-end space-x-3">
                <secondary-button
                    class="flex-1 justify-center text-center"
                    type="button"
                    @click="refuse"
                >
                  Annuler
                </secondary-button>
                <primary-button
                    :disabled="isLoading"
                    :loading="isLoading"
                    class="flex-1 justify-center text-center"
                    type="button"
                    @click="accept"
                >
                  Confirmer
                </primary-button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { CheckIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    isLoading: {
        type: Boolean
    },
    isOpen: {
        type: Boolean,
        default: false
    },
    maxWidth: {
        type: String,
        default: 'max-w-md'
    },
    icon: {
        default: CheckIcon
    },
    classIcon: {
        type: String,
        default: 'bg-primary-600 ring-primary-100 dark:ring-primary-800 dark:primary-800 text-white'
    }
})
const emits = defineEmits(['accept', 'refuse', 'close'])

function closeModal () {
    emits('close')
}

function accept () {
    emits('accept')
}

function refuse () {
    emits('refuse')
}
</script>
