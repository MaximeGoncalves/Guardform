<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="ca_agents" placeholder="CA" v-model="ca_fpt"
                       :reduce="item => item.id"
                       :selectable="selectable" stats="ca_fpt"></VehicleSelect>
    </div>
</template>

<script setup>
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";
import Skills from "@/types/Skills.js";

const props = defineProps({title: String, form: Object, agents: Array})

const ca_fpt = defineModel()

const ca_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.CA_TOUT_ENGIN))
})

const selectable = function (item) {
    const {remise, pharmacie, cuisine, officier, ...restForm} = props.form.data();

    // Vérifie si l'ID de l'élément est présent dans le reste du formulaire (hors exceptions)
    return Object.values(restForm).indexOf(item.id) < 0
}
</script>
