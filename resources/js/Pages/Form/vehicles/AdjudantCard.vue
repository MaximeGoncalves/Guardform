<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="adjudants_agents" v-model="adjudant" :reduce="item => item.id"
                 :selectable="selectable" stats="vli"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const adjudant = defineModel()

const adjudants_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.ADJUDANT))
})

const selectable = function (item) {
    return item.id !== props.form.adjudant
}
</script>
