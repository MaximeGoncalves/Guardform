<template>
    <nav class="bg-white w-full lg:w-1/5 p-2 shadow rounded">
        <div class="flex items-center justify-between mb-4">
            <h2>
                Agents
            </h2>
            <div @click="showModal = true" class="cursor-pointer bg-gray-900 p-1 rounded ">
                <PlusIcon class="w-4 h-4 text-gray-200"/>
            </div>
        </div>
        <div>
            <h2>SPP</h2>
            <ul>
                <li v-for="agent in spp" :key="agent.id"
                    class="flex items-center justify-between bg-secondary mb-1">
                    <span :class="{'line-through text-secondary': !displayable(agent)}">{{
                            agent.name
                        }} {{ agent.firstname }} </span>
                    <VBadge color="brand" v-if="!displayable(agent)">{{ getVehicle(agent) }}</VBadge>
                    <ArchiveBoxXMarkIcon class="text-red-400 hover:text-red-600 w-4 h-4 cursor-pointer"
                                         v-if="displayable(agent)" @click="removeAgent(agent.id)"/>
                </li>
            </ul>
            <hr class="my-4">
            <h2>SPV</h2>
            <ul v-if="spv.length > 0">
                <li v-for="agent in spv" :key="agent.id"
                    class="flex items-center justify-between bg-secondary mb-1">
                    <span :class="{'line-through text-secondary': !displayable(agent)}">{{
                            agent.name
                        }} {{ agent.firstname }} </span>
                    <VBadge color="brand" v-if="!displayable(agent)">{{ getVehicle(agent) }}</VBadge>
                    <ArchiveBoxXMarkIcon class="text-red-400 hover:text-red-600 w-4 h-4 cursor-pointer"
                                         v-if="displayable(agent)" @click="removeAgent(agent.id)"/>
                </li>
            </ul>
            <div v-else>
                Aucun SPV
            </div>
            <span class="block mt-4">Total : {{ form.agents.length }}</span>
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
                    CA TOUT ENGIN: {{ caengin_count }}
                </div>
                <div>
                    CE: {{ ce_count }}
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
import VBadge from "@/Components/Base/VBadge.vue";
import Poste from "@/types/Poste.js";

const props = defineProps({form: Object, agents: Array, data: Object})
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

const spp = computed(() => {
    return props.form.agents.filter(item => item.status === 'SPP');
})

const spv = computed(() => {
    return props.form.agents.filter(item => item.status === 'SPV');
})

const epa_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.EPA)).length;
})

const cod_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.COD1)).length;
})

const ce_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.CHEF_EQUIPE)).length;
})

const caengin_count = computed(() => {
    return props.form.agents.filter(item => item.skills.some(skill => skill.id === Skills.CA_TOUT_ENGIN)).length;
})

const getVehicle = function (item) {
    let foundKey = null;
    for (const key in props.data) {
        if (props.data[key] === item.id) {
            foundKey = key;
            break; // Sortir de la boucle dès qu'on a trouvé la correspondance
        }
    }
    return Poste[foundKey?.toUpperCase()];
}

const displayable = function (item) {
    const {remise, pharmacie, cuisine, ...restData} = props.data;

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restData).indexOf(item.id) < 0
}
</script>
