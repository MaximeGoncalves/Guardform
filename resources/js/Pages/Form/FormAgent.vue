<template>
    <nav class="bg-white w-1/5 p-1 shadow rounded">
        <div class="flex items-center justify-between mb-4">
            <h2>
                Agents
            </h2>
            <div @click="showModal = true" class="cursor-pointer bg-gray-900 p-1 rounded ">
                <PlusIcon class="w-4 h-4 text-gray-200"/>
            </div>
        </div>
        <div>
            <ul>
                <li v-for="agent in form.agents" :key="agent.id" class="flex items-center justify-between bg-secondary mb-1">
                    <span :class="{'line-through text-secondary': Object.values(data).indexOf(agent.id) > -1}">{{ agent.firstname }} {{ agent.name }}</span>
                        <ArchiveBoxXMarkIcon class="text-red-400 hover:text-red-600  w-4 h-4  cursor-pointer"
                                             v-if="Object.values(data).indexOf(agent.id) === -1" @click="removeAgent(agent.id)"/>
                </li>
            </ul>

            <span>Total : {{ form.agents.length }}</span>
        </div>
        <hr class="my-2">
        <div>
            <h2>Compétences</h2>
            <div>
                <div>
                    EPA: {{ epa_count }}
                </div>
                <div>
                    COD1: {{ cod_count }}
                </div>
                <div>
                    CA_TOUT_ENGIN: {{ caengin_count }}
                </div>
            </div>
        </div>
    </nav>
    <VModal :is-open="showModal" @close="showModal = false" @confirm="addAgentsToForm">
        <template #title>
            Ajouter des agents
        </template>
        <template #content>
            <div>
                <VLabel>Selectionnez des agents</VLabel>
                <VSelect label="fullname"
                         :options="agents"
                         v-model="newAgents"
                         multiple
                         :close-on-select="false"
                         :reduce="item => item.id"
                         :selectable="item => !newAgents.includes(item.id)"
                ></VSelect>
            </div>
        </template>
    </VModal>
</template>
<script setup>
import VLabel from "@/Components/Base/VLabel.vue";
import VModal from "@/Components/Base/VModal.vue";
import VSelect from "vue-select";
import {computed, ref} from "vue";
import {router} from "@inertiajs/vue3";
import Skills from "@/types/Skills.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {PlusIcon, ArchiveBoxXMarkIcon} from "@heroicons/vue/24/outline/index.js";

const props = defineProps({form: Object,agents: Array, data: Object})
const showModal = ref(false)
const newAgents = ref([])

function addAgentsToForm() {
    router.put(route('forms.agents.add', props.form.id), {
        agents: newAgents.value
    }, {
        onSuccess: () => {
            showModal.value = false
            newAgents.value = []
        }
    })
}

function removeAgent(agent) {
    router.put(route('forms.agents.delete', props.form.id), {
        agent
    })
}


const epa_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.EPA)).length;
})

const cod_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.COD1)).length;
})

const caengin_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.CA_TOUT_ENGIN)).length;
})
</script>
