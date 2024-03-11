<template>
    <div class="space-y-1">
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="ca_agents" placeholder="CA" v-model="ca" :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
        <VehicleSelect label="fullname" :options="cond_agents" placeholder="COND" v-model="cond"
                       :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
        <VehicleSelect label="fullname" :options="ce_agents" placeholder="CE1" v-model="ce1" :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
        <VehicleSelect label="fullname" :options="ce_agents" placeholder="CE2" v-model="ce2" :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
        <VehicleSelect label="fullname" :options="eq_agents" placeholder="EQ1" v-model="eq1" :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
        <VehicleSelect label="fullname" :options="eq_agents" placeholder="EQ2" v-model="eq2" :reduce="item => item.id"
                       :selectable="selectable" stats="fptl"></VehicleSelect>
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
const ce1 = defineModel('ce1')
const ce2 = defineModel('ce2')
const eq1 = defineModel('eq1')
const eq2 = defineModel('eq2')

const ca_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.CA_TOUT_ENGIN))
})

const cond_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.COD1))
})

const ce_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.CHEF_EQUIPE))
})

const eq_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.EQ_TOUT_ENGIN))
})

const selectable = function (item) {
    return Object.values(props.form).indexOf(item.id) < 0 ||
        item.id === props.form.cuisine
        || item.id === props.form.pharmacie
        || item.id === props.form.remise
}
</script>
