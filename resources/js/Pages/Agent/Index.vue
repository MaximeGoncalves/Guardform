<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Agents</h1>
            <Link :href="route('agents.create')">
                <PrimaryButton>Ajouter un Agent</PrimaryButton>
            </Link>
        </header>

        <div>
            <div class="flex justify-end space-x-4 mb-2">
                <VInput @change="search" v-model="searchInput" class="w-72"/>
                <PrimaryButton @click="search">Rechercher</PrimaryButton>
            </div>
            <table>
                <thead>
                <tr>
                    <th>Nom / Prénom</th>
                    <th>Status</th>
                    <th>Régime</th>
                    <th>Section</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="agent in agents" :key="agent.id">
                  <td>{{ agent.firstname }} {{ agent.name }}</td>
                    <td>{{ agent.status }}</td>
                    <td>{{ agent.cycle }}</td>
                    <td>{{ agent.section}}</td>
                    <td>
                        <Link
                            :href="route('agents.edit', agent.id)"
                            class="py-1 px-2 rounded"
                        >Modifier</Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VInput from "@/Components/Base/VInput.vue";
import {ref} from "vue";

defineOptions({layout: AuthenticatedLayout})
defineProps({agents: Array})


const searchInput = ref('')

function search() {
    router.get(route('agents.index'), {search: searchInput.value}, {
        preserveState:true
    })
}
</script>
