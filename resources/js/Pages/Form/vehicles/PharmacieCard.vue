<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="pharmacie_agents" placeholder="Pharmacien" v-model="pharmacie" :reduce="item => item.id"
                 stats="pharmacie"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const pharmacie = defineModel()

const pharmacie_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.PHARMACIE))
})

</script>
