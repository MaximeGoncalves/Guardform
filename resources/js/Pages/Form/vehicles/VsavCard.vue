<template>
    <div class="space-y-1">
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="ca_agents" placeholder="CA" v-model="ca" :reduce="item => item.id"
                       :selectable="selectable" :stats="getLabel()"></VehicleSelect>
        <VehicleSelect label="fullname" :options="cond_agents" placeholder="COND" v-model="cond"
                       :reduce="item => item.id"
                       :selectable="selectable" :stats="getLabel()"></VehicleSelect>
        <VehicleSelect label="fullname" :options="eq_agents" placeholder="EQ" v-model="eq" :reduce="item => item.id"
                       :selectable="selectable" :stats="getLabel()"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const ca = defineModel('ca')
const cond = defineModel('cond')
const eq = defineModel('eq')

const ca_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.CA_UNE_EQUIPE))
})

const cond_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.COND_VSAV))
})

const eq_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.EQ_VSAV))
})

const selectable = function (item) {
    const { remise, pharmacie, cuisine, ...restForm } = props.form;

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restForm).indexOf(item.id) < 0
}

function getLabel() {
    if(props.form.is_night){
        if(props.title === 'VSAV 1'){
            return 'vsav'
        }else {
            return 'vsav2'
        }
    }
    return 'vsav';
}
</script>
