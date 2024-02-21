<template>
    <TransitionRoot :show="isOpen" appear as="template">
        <Dialog as="div" class="relative z-30" @close="closeModal">
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
                    class="flex min-h-full items-start justify-center p-4 text-center"
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
                            class="w-full transform rounded-2xl border p-6 text-left align-middle shadow-xl transition-all bg-primary border-primary"
                        >
                            <DialogTitle
                                as="h3"
                                class="mb-4 text-lg font-semibold leading-6 text-primary"
                            >
                                <slot name="title"></slot>
                            </DialogTitle>
                            <div class="mt-2 text-secondary">
                                <slot name="content"></slot>
                            </div>

                            <div class="mt-4 flex justify-end space-x-2">
                                <SecondaryButton @click="closeModal">Annuler</SecondaryButton>
                                <PrimaryButton
                                    :loading="isLoading"
                                    @click="confirm"
                                >
                                    Confirmer
                                </PrimaryButton>
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

const props = defineProps({
    isOpen: {
        default: false,
        type: Boolean
    },
    isLoading: {
        default: false,
        type: Boolean
    },
    maxWidth: {
        default: 'max-w-2xl',
        type: String
    }
})
const emits = defineEmits(['close', 'confirm'])

function confirm () {
    emits('confirm')
}

function closeModal () {
    emits('close')
}
</script>
