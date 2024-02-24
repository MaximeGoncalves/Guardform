<template>
    <div class="space-y-1">
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="ca_agents" placeholder="CA" v-model="ca" :reduce="item => item.id"
                       :selectable="selectable" :stats="getStatsLabel()"></VehicleSelect>
        <VehicleSelect label="fullname" :options="cond_agents" placeholder="COND" v-model="cond"
                       :reduce="item => item.id"
                       :selectable="selectable" :stats="getStatsLabel()"></VehicleSelect>
        <VehicleSelect label="fullname" :options="eq_agents" placeholder="EQ" v-model="eq" :reduce="item => item.id"
                       :selectable="selectable" :stats="getStatsLabel()"></VehicleSelect>
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

function getStatsLabel() {
    if(props.title === "VTU" || props.title === "VSR") {
        return 'reserve'
    }else{
        return 'vsav2'
    }
}

const selectable = function (item) {
    return item.id !== props.form.ca_vsav1
        && item.id !== props.form.cond_vsav1
        && item.id !== props.form.eq_vsav1
        && item.id !== props.form['ca_' + props.title.toLowerCase().replace(/\s+/g, '')]
        && item.id !== props.form['cond_' + props.title.toLowerCase().replace(/\s+/g, '')]
        && item.id !== props.form['eq_' + props.title.toLowerCase().replace(/\s+/g, '')]
        && item.id !== props.form.ca_fptl
        && item.id !== props.form.cond_fptl
        && item.id !== props.form.ce1_fptl
        && item.id !== props.form.ce2_fptl
        && item.id !== props.form.eq1_fptl
        && item.id !== props.form.eq2_fptl
        && item.id !== props.form.vli
        && item.id !== props.form.epa
}
</script>
