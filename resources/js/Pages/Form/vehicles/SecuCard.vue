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
    return Object.values(props.form).indexOf(item.id) < 0
}
</script>
