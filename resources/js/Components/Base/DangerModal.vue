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
                <div class="fixed inset-0 bg-black bg-opacity-25"/>
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
                            class="w-full transform overflow-hidden rounded-2xl p-6 text-left align-middle shadow-xl transition-all bg-primary"
                        >
                            <div class="mb-6 flex items-center justify-center">
                                <div
                                    class="rounded-full bg-red-600 p-2 text-white ring-8 ring-red-100 dark:ring-red-900">
                                    <component :is="icon" class="h-9 w-9 font-semibold"/>
                                </div>
                            </div>
                            <DialogTitle
                                as="h3"
                                class="text-center text-lg font-medium leading-6 text-primary"
                            >
                                <slot name="title"></slot>
                            </DialogTitle>
                            <div class="mt-4 mb-8 text-center text-sm text-secondary">
                                <slot name="content"></slot>
                            </div>

                            <div class="mt-4 flex justify-end space-x-3">
                                <SecondaryButton
                                    class="flex-1 justify-center text-center"
                                    type="button"
                                    @click="refuse"
                                >
                                    Annuler
                                </SecondaryButton>
                                <danger-button
                                    :loading="isLoading"
                                    class="flex-1 justify-center text-center"
                                    type="button"
                                    @click="accept"
                                >
                                    Confirmer
                                </danger-button>
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
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { TrashIcon } from '@heroicons/vue/24/outline'
import DangerButton from '@/Components/DangerButton.vue'

const props = defineProps({
    maxWidth: {
        type: String,
        default: 'max-w-md'
    },
    isOpen: {
        type: Boolean,
        default: false
    },
    icon: {
        default: TrashIcon
    },
    isLoading: {
        type: Boolean
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
