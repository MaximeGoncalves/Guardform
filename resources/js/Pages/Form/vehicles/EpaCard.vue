<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="vli_agents" placeholder="COND" v-model="vli" :reduce="item => item.id"
                 :selectable="selectable" stats="epa"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const vli = defineModel()

const vli_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.EPA))
})

const selectable = function (item) {
    return Object.values(props.form).indexOf(item.id) < 0 ||
        item.id === props.form.cuisine
        || item.id === props.form.pharmacie
        || item.id === props.form.remise
}
</script>
