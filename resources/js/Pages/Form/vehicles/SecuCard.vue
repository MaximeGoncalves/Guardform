<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="secu_agents" placeholder="COND" v-model="secu"
                       :reduce="item => item.id"
                       :selectable="selectable" stats="secu"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const secu = defineModel()

const secu_agents = computed(() => {
    return props.agents
})

const selectable = function (item) {
    const { remise, pharmacie, cuisine, ...restForm } = props.form;

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restForm).indexOf(item.id) < 0
}
</script>
