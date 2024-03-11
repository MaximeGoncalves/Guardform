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
    const { remise, pharmacie, cuisine, ...restForm } = props.form;

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restForm).indexOf(item.id) < 0
}
</script>
