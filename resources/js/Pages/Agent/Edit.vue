<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Modifier un agent</h1>
            <DangerButton @click="deleteAgent">Supprimer</DangerButton>
        </header>

        <div class="bg-white p-8 rounded shadow grid lg:grid-cols-2 gap-8 ">
            <VInput label="Prénom" v-model="form.firstname"/>
            <VInput label="Nom" v-model="form.name"/>
            <div>
                <VLabel>Status</VLabel>
                <v-select :clearable="false" :options="['SPP','SPV']" v-model="form.status"></v-select>
            </div>
            <div v-if="form.status === 'SPP' ">
                <VLabel>Cycle</VLabel>
                <v-select :clearable="false" v-if="form.status === 'SPP' " :options="['12','24']"
                          v-model="form.cycle"></v-select>
            </div>
            <div v-if="form.status === 'SPP' ">
                <VLabel>Section</VLabel>
                <v-select :clearable="false" :options="[1,2,3,4]"
                          v-model="form.section"></v-select>
            </div>
            <div>
                <VLabel>Compétences</VLabel>
                <v-select label="name"
                          :options="skills" :close-on-select="false"
                          v-model="form.skills"
                          :selectable="item => !form.skills.includes(item.id)"
                          :reduce="item => item.id"
                          multiple></v-select>
                <small class="cursor-pointer text-blue-500" @click="pushSkills">Ajouter toutes les compétences</small>
            </div>

        </div>
        <div class="flex justify-end mt-4">
            <PrimaryButton @click="update">Enregistrer</PrimaryButton>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VInput from "@/Components/Base/VInput.vue";
import {router, useForm} from "@inertiajs/vue3";
import VSelect from 'vue-select'
import {watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VLabel from "@/Components/Base/VLabel.vue";
import DangerButton from "@/Components/DangerButton.vue";

defineOptions({layout: AuthenticatedLayout})
const props = defineProps({skills: Array, agent: Object})

const form = useForm({
    firstname: props.agent.firstname,
    name: props.agent.name,
    status: props.agent.status,
    cycle: props.agent.cycle,
    section: props.agent.section,
    skills: props.agent.skills.map(item => item.id),
})

function update() {
    form.put(route('agents.update', props.agent.id))
}

function pushSkills() {
    form.skills = props.skills.map(item => item.id)
}

watch(() => form.status, (value) => {
    if (value === 'SPV') {
        form.cycle = null
        form.section = null
    }
})

function deleteAgent(){
    router.delete(route('agents.destroy', props.agent.id), {})
}
</script>
