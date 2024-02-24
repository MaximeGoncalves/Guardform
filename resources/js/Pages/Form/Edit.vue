<template>
    <div class="px-4 mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <h1 class="font-medium text-xl">{{  moment(form.garde.date).locale('fr').format('LL') }} - {{ form.is_night ? 'Nuit' : 'Jour'}}</h1>
                <Link v-if="!form.is_night" :href="route('forms.edit', form.id + 1)" class="text-indigo-400 hover:text-indigo-600 text-sm">Modifier la nuit</Link>
                <Link v-else :href="route('forms.edit', form.id - 1)" class="text-indigo-400 hover:text-indigo-600 text-sm">Modifier la journée</Link>
            </div>
            <primary-button @click="update" :form="data" :icon="PlusIcon">Enregistrer</primary-button>
        </header>

        <div class="flex space-x-2 items-start">
            <FormAgent :agents :form :data></FormAgent>
            <div class="flex-1 bg-white grid grid-cols-4 gap-4 p-2 shadow rounded items-start">
                <VsavCard :agents="form.agents"
                          :form="data"
                          title="VSAV 1"
                          v-model:ca="data.ca_vsav1"
                          v-model:cond="data.cond_vsav1"
                          v-model:eq="data.eq_vsav1"
                />
                <VsavCard v-if="!form.is_night" :agents="form.agents"
                          :form="data"
                          title="VSAV 2"
                          v-model:ca="data.ca_vsav2"
                          v-model:cond="data.cond_vsav2"
                          v-model:eq="data.eq_vsav2"
                />
                <VtuCard v-else :agents="form.agents"
                         :form="data"
                         title="VSAV 2"
                         v-model:ca="data.ca_vsav2"
                         v-model:cond="data.cond_vsav2"
                         v-model:eq="data.eq_vsav2"
                />
                <VtuCard
                    :agents="form.agents"
                    :form="data"
                    title="VTU"
                    v-model:ca="data.ca_vtu"
                    v-model:cond="data.cond_vtu"
                    v-model:eq="data.eq_vtu"
                />
                <VtuCard
                    :agents="form.agents"
                    :form="data"
                    title="VSR"
                    v-model:ca="data.ca_vsr"
                    v-model:cond="data.cond_vsr"
                    v-model:eq="data.eq_vsr"
                />
                <FptlCard
                    :agents="form.agents"
                    :form="data"
                    title="FPTL"
                    v-model:ca="data.ca_fptl"
                    v-model:cond="data.cond_fptl"
                    v-model:ce1="data.ce1_fptl"
                    v-model:ce2="data.ce2_fptl"
                    v-model:eq1="data.eq1_fptl"
                    v-model:eq2="data.eq2_fptl"
                />
                <VliCard :agents="form.agents"
                          :form="data"
                          title="VLI"
                          v-model="data.vli"
                />
                <EpaCard :agents="form.agents"
                         :form="data"
                         title="EPA"
                         v-model="data.epa"
                />

            </div>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, Link} from "@inertiajs/vue3";
import FormAgent from "@/Pages/Form/FormAgent.vue";
import VsavCard from "@/Pages/Form/vehicles/VsavCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VtuCard from "@/Pages/Form/vehicles/VtuCard.vue";
import FptlCard from "@/Pages/Form/vehicles/FptlCard.vue";
import VliCard from "@/Pages/Form/vehicles/VliCard.vue";
import EpaCard from "@/Pages/Form/vehicles/EpaCard.vue";
import {PlusIcon} from "@heroicons/vue/24/outline/index.js";
import moment from "moment/min/moment-with-locales";

defineOptions({layout: AuthenticatedLayout})

const props = defineProps({form: Object, agents: Array})

const data = useForm({
    ca_vsav1: props.form.ca_vsav1,
    cond_vsav1: props.form.cond_vsav1,
    eq_vsav1: props.form.eq_vsav1,
    ca_vsav2: props.form.ca_vsav2,
    cond_vsav2: props.form.cond_vsav2,
    eq_vsav2: props.form.eq_vsav2,
    ca_vtu: props.form.ca_vtu,
    cond_vtu: props.form.cond_vtu,
    eq_vtu: props.form.eq_vtu,
    ca_vsr: props.form.ca_vsr,
    cond_vsr: props.form.cond_vsr,
    eq_vsr: props.form.eq_vsr,
    ca_fptl: props.form.ca_fptl,
    cond_fptl: props.form.cond_fptl,
    ce1_fptl: props.form.ce1_fptl,
    ce2_fptl: props.form.ce2_fptl,
    eq1_fptl: props.form.eq1_fptl,
    eq2_fptl: props.form.eq2_fptl,
    vli: props.form.vli,
    epa: props.form.epa,
})

function update() {
    data.put(route('forms.update', props.form.id) )
}

</script>
