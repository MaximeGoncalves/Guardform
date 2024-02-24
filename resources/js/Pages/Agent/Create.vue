<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Ajouter un agent</h1>
        </header>

        <div class="bg-white p-8 rounded shadow grid grid-cols-2 gap-8 ">
            <VInput label="Prénom" v-model="form.firstname" :error="form.errors.firstname"/>
            <VInput label="Nom" v-model="form.name" :error="form.errors.name"/>
            <div>
                <VLabel>Status</VLabel>
                <v-select :clearable="false" :options="['SPP','SPV']" v-model="form.status"></v-select>
                <InputError :message="form.errors.status"></InputError>
            </div>
            <div v-if="form.status === 'SPP' ">
                <VLabel>Cycle</VLabel>
                <v-select :clearable="false" v-if="form.status === 'SPP' " :options="['12','24']"
                          v-model="form.cycle"></v-select>
                <InputError :message="form.errors.cycle"></InputError>

            </div>
            <div v-if="form.status === 'SPP' ">
                <VLabel>Section</VLabel>
                <v-select :clearable="false" :options="[1,2,3,4]"
                          v-model="form.section"></v-select>
                <InputError :message="form.errors.section"></InputError>

            </div>
            <div>
                <VLabel>Compétences</VLabel>
                <v-select label="name" :options="skills"
                          :selectable="item => !form.skills.includes(item.id)"
                          :close-on-select="false" v-model="form.skills"
                          :reduce="item => item.id" multiple></v-select>
                <small class="cursor-pointer text-blue-500" @click="pushSkills">Ajouter toutes les compétences</small>
                <InputError :message="form.errors.skills"></InputError>

            </div>
        </div>
        <div class="flex justify-end mt-4">
            <PrimaryButton @click="store" :form>Ajouter</PrimaryButton>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VInput from "@/Components/Base/VInput.vue";
import {useForm} from "@inertiajs/vue3";
import VSelect from 'vue-select'
import {watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VLabel from "@/Components/Base/VLabel.vue";
import InputError from "@/Components/InputError.vue";

defineOptions({layout: AuthenticatedLayout})
const props = defineProps({skills: Array})

const form = useForm({
    firstname: '',
    name: '',
    status: 'SPP',
    cycle: '12',
    section: 1,
    skills: [],
})

function store() {
    form.post(route('agents.store'))
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
</script>
