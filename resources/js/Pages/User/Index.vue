<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Utilisateurs</h1>
            <Link :href="route('users.create')">
                <PrimaryButton>Ajouter un Utilisateur</PrimaryButton>
            </Link>
        </header>

        <div>
            <table>
                <thead>
                <tr>
                    <th>Nom / Prénom</th>
                    <th>Email</th>
                    <th>Section</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.firstname }} {{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.section}}</td>
                    <td>
                        <Link
                            :href="route('users.edit', user.id)"
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
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineOptions({layout: AuthenticatedLayout})
defineProps({users: Array})
</script>
