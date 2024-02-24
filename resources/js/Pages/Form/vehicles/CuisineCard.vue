<template>
    <div>
        <h2>{{ title }}</h2>
        <VehicleSelect label="fullname" :options="cuisine_agents" placeholder="Cuisine" v-model="cuisine" :reduce="item => item.id"
                 :selectable stats="cuisine"></VehicleSelect>
    </div>
</template>

<script setup>
import VSelect from "vue-select";
import Skills from "@/types/Skills.js";
import {computed} from "vue";
import VehicleSelect from "@/Components/VehicleSelect.vue";

const props = defineProps({title: String, form: Object, agents: Array})

const cuisine = defineModel()

const cuisine_agents = computed(() => {
    return props.agents.filter(item => item.skills.some(skill => skill.id === Skills.CUISINE))
})
const selectable = function (item) {
    return item.id !== props.form.cuisine
}

</script>
