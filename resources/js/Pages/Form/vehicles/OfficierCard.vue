<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="officiers_agents" v-model="officier" :reduce="item => item.id"
                 :selectable="selectable" stats="vli"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const officier = defineModel()

const officiers_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.OFFICIER))
})

const selectable = function (item) {
    const { remise, pharmacie, cuisine, ca_fpt, ...restForm } = props.form.data();

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restForm).indexOf(item.id) < 0
}
</script>
