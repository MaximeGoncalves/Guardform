<template>
    <div class="px-4 mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <h1 class="font-medium text-xl">{{ moment(form.garde.date).locale('fr').format('LL') }} -
                    {{ form.is_night ? 'Nuit' : 'Jour' }}</h1>
                <Link v-if="!form.is_night" :href="route('forms.edit', form.id + 1)"
                      class="text-indigo-400 hover:text-indigo-600 text-sm">Modifier la nuit
                </Link>
                <Link v-else :href="route('forms.edit', form.id - 1)"
                      class="text-indigo-400 hover:text-indigo-600 text-sm">Modifier la journée
                </Link>
            </div>
<!--            <primary-button @click="update" :form="data" :icon="PlusIcon">Enregistrer</primary-button>-->
        </header>

        <div class="lg:flex lg:space-x-2 items-start max-lg:space-y-4">
            <FormAgent :agents :form :data></FormAgent>
            <div class="flex-1 bg-white grid grid-col-1 lg:grid-cols-4 gap-x-4 gap-y-8 p-2 shadow rounded items-start">
                <VsavCard :agents="form.agents"
                          :form="data"
                          title="VSAV 1"
                          v-model:ca="data.ca_vsav1"
                          v-model:cond="data.cond_vsav1"
                          v-model:eq="data.eq_vsav1"
                />
                <VsavCard :agents="form.agents"
                          :form="data"
                          title="VSAV 2"
                          v-model:ca="data.ca_vsav2"
                          v-model:cond="data.cond_vsav2"
                          v-model:eq="data.eq_vsav2"
                />
                <!--                <VtuCard v-else :agents="form.agents"-->
                <!--                         :form="data"-->
                <!--                         title="VSAV 2"-->
                <!--                         v-model:ca="data.ca_vsav2"-->
                <!--                         v-model:cond="data.cond_vsav2"-->
                <!--                         v-model:eq="data.eq_vsav2"-->
                <!--                />-->
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
                <div class="space-y-4">
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
               <div class="space-y-4">
                   <SecuCard :agents="form.agents"
                             :form="data"
                             title="Cadre securité"
                             v-model="data.secu"
                   />
                   <FptCard :agents="form.agents"
                             :form="data"
                             title="FPT"
                             v-model="data.ca_fpt"
                   />
               </div>
                <div class="space-y-4" v-if="!form.is_night">
                    <PharmacieCard
                        :agents="form.agents"
                        :form="data"
                        title="Pharmacie"
                        v-model="data.pharmacie"/>
                    <RemiseCard
                        :agents="form.agents"
                        :form="data"
                        title="Remise"
                        v-model="data.remise"/>
                    <CuisineCard
                        :agents="form.agents"
                        :form="data"
                        title="Cuisine"
                        v-model="data.cuisine"/>
                </div>

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
import SecuCard from "@/Pages/Form/vehicles/SecuCard.vue";
import PharmacieCard from "@/Pages/Form/vehicles/PharmacieCard.vue";
import RemiseCard from "@/Pages/Form/vehicles/RemiseCard.vue";
import CuisineCard from "@/Pages/Form/vehicles/CuisineCard.vue";
import {watch} from "vue";
import FptCard from "@/Pages/Form/vehicles/FptCard.vue";

defineOptions({layout: AuthenticatedLayout})

const props = defineProps({form: Object, agents: Array})

const data = useForm({
    is_night: props.form.is_night,
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
    secu: props.form.secu,
    ca_fpt: props.form.ca_fpt,
    pharmacie: props.form.pharmacie,
    remise: props.form.remise,
    cuisine: props.form.cuisine,
})

watch(() => data.data() , function (old, value) {
    update()
})

function update() {
    data.put(route('forms.update', props.form.id))
}

</script>
