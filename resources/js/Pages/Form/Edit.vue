<template>
    <div class="px-4 mx-auto pb-8">
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
            <Link :href="route('recap', form.garde.id)"
                  class="text-indigo-400 hover:text-indigo-600 text-sm">Recap
            </Link>
<!--                        <primary-button @click="update" :form="data" :icon="PlusIcon">Enregistrer</primary-button>-->
        </header>

        <div class="lg:flex lg:space-x-2 items-start max-lg:space-y-4">
            <FormAgent :agents :form :data></FormAgent>
            <div class="flex-1 bg-white grid grid-col-1 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8 p-2 shadow rounded items-start">
                <OfficierCard :agents="form.agents" :form="data" title="Officier de garde" v-model="data.officier"></OfficierCard>
                <AdjudantCard :agents="form.agents" :form="data" title="Adjudant de garde" v-model="data.adjudant"></AdjudantCard>
                <SecuCard :agents="form.agents"
                          :form="data"
                          title="Cadre securité"
                          v-model="data.secu"
                />
                <PlantonCard :agents="form.agents" :form="data" title="Planton" v-model="data.planton"></PlantonCard>
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
                <VsavCard :agents="form.agents"
                          :form="data"
                          title="VSAV 3"
                          v-model:ca="data.ca_vsav3"
                          v-model:cond="data.cond_vsav3"
                          v-model:eq="data.eq_vsav3"
                />
                <VliCard :agents="form.agents"
                         :form="data"
                         title="VLI"
                         v-model="data.vli"
                />
                <div class="space-y-8">
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
                    <EpaCard :agents="form.agents"
                             :form="data"
                             title="EPA"
                             v-model="data.epa"
                    />
                </div>
                <FptCard :agents="form.agents"
                         :form="data"
                         title="FPT"
                         v-model="data.ca_fpt"
                />
                <div class="space-y-8">
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
                </div>
                <div class="space-y-4">
                </div>
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
                <div class="col-span-4 flex w-full space-x-4">
                    <div class="w-2/4 space-y-4">
                        <div>
                            <h2>FMA 1</h2>
                            <VInput v-model="guardData.fma1"/>
                        </div>
                        <div>
                            <h2>FMA 2</h2>
                            <VInput v-model="guardData.fma2"/>
                        </div>
                    </div>
                    <div class="w-full">
                        <h2>Consignes / Notes</h2>
                        <VTextarea v-model="guardData.consignes" rows="7"></VTextarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="shadow bg-white rounded mt-4 p-1 mb-8">
            <StatsTable :type="data.is_night ? 'Nuit' : 'Jour'" :agents="form.agents"/>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, Link, router} from "@inertiajs/vue3";
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
import {ref, watch} from "vue";
import FptCard from "@/Pages/Form/vehicles/FptCard.vue";
import StatsTable from "@/Pages/Stats/StatsTable.vue";
import VInput from "@/Components/Base/VInput.vue";
import debounce from 'lodash.debounce'
import VTextarea from "@/Components/Base/VTextarea.vue";
import OfficierCard from "@/Pages/Form/vehicles/OfficierCard.vue";
import AdjudantCard from "@/Pages/Form/vehicles/AdjudantCard.vue";
import PlantonCard from "@/Pages/Form/vehicles/PlantonCard.vue";
defineOptions({layout: AuthenticatedLayout})

const props = defineProps({form: Object, agents: Array})
const timeout = ref(null);

const guardData = useForm({
    fma1: props.form.garde.fma1,
    fma2: props.form.garde.fma2,
    consignes: props.form.garde.consignes,
})

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
    officier: props.form.officier,
    adjudant: props.form.adjudant,
    planton: props.form.planton,
})

watch(() => data.data(), function (old, value) {
    update()
})

watch(() => guardData.data(), debounce(() => {
    guardData.put(route('guards.update', props.form.garde.id), {
        preserveScroll: true,
        preserveState: true,
    })
}, 500));

function update() {
    data.put(route('forms.update', props.form.id), {
        preserveState: true,
        preserveScroll: true,
    })
}

</script>
