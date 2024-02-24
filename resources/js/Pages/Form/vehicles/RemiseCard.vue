<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="remise_agents" placeholder="Remise" v-model="remise" :reduce="item => item.id"
                 stats="remise"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const remise = defineModel()

const remise_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.REMISE))
})

</script>
